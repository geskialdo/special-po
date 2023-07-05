<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteCollectionInterface;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class MenuGenerator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->method() !== 'GET' || !$request->session()->has('user')) {
            return $next($request);
        }

        $route_list_and_roles = $this->getRouteListAndRoles(Route::getRoutes());

        $user_roles = $request->session()->get('user')['roles'];
        $current_route = strtolower((str_starts_with(trim(Route::current()->uri), '/') ? '' : '/') . trim(Route::current()->uri));

        $menu_items = $this->getMenuItems();
        $generated = $this->generateSidebarAndPagetitleString($menu_items, $user_roles, $route_list_and_roles, $current_route);
        $request->merge($generated);

        return $next($request);
    }

    private function getMenuItems()
    {
        $module_path = base_path('app/Modules');
        if (!is_dir($module_path)) {
            return [];
        }

        $menu_items = [];
        $menu_files = glob($module_path . '/*/menu.php');
        foreach ($menu_files as $file) {
            $raw_data = null;
            try {
                $raw_data = require($file);
            } catch (\Throwable $th) {
                //throw $th;
            }

            if (is_array($raw_data)) {
                $menu_items = array_merge($menu_items, $raw_data);
            }
        }

        return $this->sortMenuItems($menu_items);
    }

    private function getRouteListAndRoles(RouteCollectionInterface $routes)
    {
        $route_list = [];
        $route_roles = [];
        foreach ($routes as $route) {
            $middleware = $route->middleware();
            $roles = null;
            if (!in_array('GET', $route->methods) || !in_array('menugen', $middleware)) {
                continue;
            }
            foreach ($middleware as $mdw) {
                $mdw = trim($mdw);
                if ($mdw === 'isloggedin') {
                    $roles = [];
                } else if (str_starts_with($mdw, 'isloggedin:')) {
                    $roles = [];
                    if (strlen($mdw) === 11) {
                        continue;
                    }
                    foreach (explode(',', substr($mdw, 11)) as $role) {
                        $roles[] = trim($role);
                    }
                }
            }
            if ($roles === null) {
                continue;
            }
            $route_uri = strtolower((str_starts_with(trim($route->uri()), '/') ? '' : '/') . trim($route->uri()));
            $route_list[] = $route_uri;
            $route_roles[$route_uri] = $roles;
        }
        return [
            'route_list' => $route_list,
            'route_roles' => $route_roles
        ];
    }

    private function generateSidebarAndPagetitleString(array $menu_items, $user_roles, $route_list_and_roles, $current_route): array
    {
        $routes = $route_list_and_roles['route_list'];
        $route_roles = $route_list_and_roles['route_roles'];
        $sidebar_string = '';
        $pagetitle_string = '';
        foreach ($menu_items as $item) {
            if (
                !is_array($item) || !isset($item['type']) || !is_string($item['type']) || !isset($item['title']) || !is_string($item['title'])
                || (strtolower($item['type']) !== 'menu' && strtolower($item['type']) !== 'menu-collapse' && strtolower($item['type']) !== 'heading')
            ) {
                continue;
            }

            if (strtolower($item['type']) === 'heading') {
                $sidebar_string .= '<li class="nav-heading">' . trim($item['title']) . '</li>';
                continue;
            }

            if (!isset($item['menu']) || !is_string($item['menu']) || !isset($item['icon_class']) || !is_string($item['icon_class'])) {
                continue;
            }

            if (strtolower($item['type']) === 'menu' && isset($item['route']) && is_string($item['route'])) {
                $route = strtolower((str_starts_with(trim($item['route']), '/') ? '' : '/') . trim($item['route']));
                
                if (!in_array($route, $routes) || (count($route_roles[$route]) > 0 && count(array_intersect($user_roles, $route_roles[$route])) === 0)) {
                    continue;
                }

                //generate the parent here
                $active = $current_route === $route;
                $hc_active = false;
                if (!$active && isset($item['hidden_children']) && is_array($item['hidden_children'])) {
                    //generate the hidden children here
                    foreach ($item['hidden_children'] as $hc) {
                        if (!isset($hc['title']) || !is_string($hc['title']) || !isset($hc['route']) || !is_string($hc['route'])) {
                            continue;
                        }

                        $hroute = strtolower((str_starts_with(trim($hc['route']), '/') ? '' : '/') . trim($hc['route']));
                        if (!in_array($hroute, $routes) || (count($route_roles[$hroute]) > 0 && count(array_intersect($user_roles, $route_roles[$hroute])) === 0)) {
                            continue;
                        }

                        $hc_active = $current_route === $hroute;
                        if ($hc_active) {
                            $pagetitle_string = '
                            <div class="pagetitle">
                                <h1>' . trim($hc['title']) . '</h1>
                                <nav>
                                    <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                    <li class="breadcrumb-item"><a href="' . $route . '">' . trim($item['menu']) . '</a></li>
                                    <li class="breadcrumb-item active" style="color: #b3a98b">' . trim($hc['title']) . '</li>
                                    </ol>
                                </nav>
                            </div>
                            ';
                            break;
                        }
                    }
                }

                $sidebar_string .= '
                <li class="nav-item">
                    <a class="nav-link' . ($active || $hc_active ? '' : ' collapsed') . '" href="' . $route . '">
                    <i class="' . trim($item['icon_class']) . '"></i>
                    <span>' . trim($item['menu']) . '</span>
                    </a>
                </li>
                ';

                if ($active) {
                    $pagetitle_string = '
                    <div class="pagetitle">
                        <h1>' . trim($item['title']) . '</h1>
                        <nav>
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">' . trim($item['title']) . '</li>
                            </ol>
                        </nav>
                    </div>
                    ';
                }
            } else if (strtolower($item['type']) === 'menu-collapse' && isset($item['children']) && is_array($item['children'])) {
                //generate the parent here
                $children_string = '';
                $show = false;

                foreach ($item['children'] as $mc) {
                    if (!is_array($mc) || !isset($mc['menu']) || !is_string($mc['menu']) || !isset($mc['title']) || !is_string($mc['title']) || !isset($mc['route']) || !is_string($mc['route'])) {
                        continue;
                    }

                    $route = strtolower((str_starts_with(trim($mc['route']), '/') ? '' : '/') . trim($mc['route']));
                    if (!in_array($route, $routes) || (count($route_roles[$route]) > 0 && count(array_intersect($user_roles, $route_roles[$route])) === 0)) {
                        continue;
                    }

                    $mc_active = $current_route === $route;
                    $hc_active = false;
                    //generate the children here
                    if (!$mc_active && isset($mc['hidden_children']) && is_array($mc['hidden_children'])) {
                        //generate the hidden (grand) children here
                        foreach ($mc['hidden_children'] as $hc) {
                            if (!isset($hc['title']) || !is_string($hc['title']) || !isset($hc['route']) || !is_string($hc['route'])) {
                                continue;
                            }

                            $hroute = strtolower((str_starts_with(trim($hc['route']), '/') ? '' : '/') . trim($hc['route']));
                            if (!in_array($hroute, $routes) || (count($route_roles[$hroute]) > 0 && count(array_intersect($user_roles, $route_roles[$hroute])) === 0)) {
                                continue;
                            }

                            $hc_active = $current_route === $hroute;
                            if ($hc_active) {
                                $pagetitle_string = '
                                <div class="pagetitle">
                                    <h1>' . trim($mc['title']) . '</h1>
                                    <nav>
                                        <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                                        <li class="breadcrumb-item">' . trim($item['menu']) . '</li>
                                        <li class="breadcrumb-item"><a href="' . $route . '">' . trim($mc['title']) . '</a></li>
                                        <li class="breadcrumb-item active" style="color: #b3a98b">' . trim($hc['title']) . '</li>
                                        </ol>
                                    </nav>
                                </div>
                                ';
                                break;
                            }
                        }
                    }

                    $children_string .= '
                    <li>
                        <a href="' . $route . '"' . ($mc_active || $hc_active ? ' class="active"' : '') . '>
                        <i class="bi bi-circle"></i><span>' . trim($mc['menu']) . '</span>
                        </a>
                    </li>
                    ';

                    if ($mc_active) {
                        $pagetitle_string = '
                        <div class="pagetitle">
                            <h1>' . trim($mc['title']) . '</h1>
                            <nav>
                                <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item">' . trim($item['menu']) . '</li>
                                <li class="breadcrumb-item active">' . trim($mc['title']) . '</li>
                                </ol>
                            </nav>
                        </div>
                        ';
                    }

                    $show = $show || $mc_active || $hc_active;
                }

                if (empty($children_string)) {
                    continue;
                }

                $random_id = rand() . '-' . rand();

                if ($show) {
                    $sidebar_string .= '
                    <li class="nav-item">
                        <a class="nav-link " data-bs-target="#' . $random_id . '-nav" data-bs-toggle="collapse" href="#">
                            <i class="' . trim($item['icon_class']) . '"></i><span>' . trim($item['menu']) . '</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="' . $random_id . '-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                            ' . $children_string . '
                        </ul>
                    </li>
                    ';
                } else {
                    $sidebar_string .= '
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#' . $random_id . '-nav" data-bs-toggle="collapse" href="#"
                            aria-expanded="false">
                            <i class="' . trim($item['icon_class']) . '"></i><span>' . trim($item['menu']) . '</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="' . $random_id . '-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                            ' . $children_string . '
                        </ul>
                    </li>
                    ';
                }
            }

        }
        return [
            'auto_generated_sidebar_string' => $sidebar_string,
            'auto_generated_pagetitle_string' => $pagetitle_string
        ];
    }

    private function sortMenuItems(array $data): array
    {
        $numbered = [];
        $unnumbered = [];
        foreach ($data as $value) {
            if (!is_array($value)) {
                continue;
            }

            if (isset($value['position']) && is_int($value['position'])) {
                $numbered[$value['position']][] = $value;
                continue;
            }

            $unnumbered[] = $value;
        }

        ksort($numbered, SORT_NUMERIC);
        if (count($unnumbered) > 0) {
            $numbered[max(array_keys($numbered)) + 1] = $unnumbered;
        }

        $cleaned = [];
        foreach ($numbered as $value) {
            foreach ($value as $menu) {
                $cleaned[] = $menu;
            }
        }

        return $cleaned;
    }
}