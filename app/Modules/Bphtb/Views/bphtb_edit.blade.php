@extends('views.layout')

@section('title', $title)

@section('content')
    @parent

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-12">
                <div class="row">
                    Halaman Edit BPHTB {{ $id }}
                </div>
            </div><!-- End Left side columns -->
        </div>
    </section>

@endsection

@section('modal')
    {{-- isikan modal di sini     --}}
@endsection

@section('css')
    {{-- isikan css di sini     --}}
@endsection

@section('js')
    {{-- isikan js di sini --}}
@endsection
