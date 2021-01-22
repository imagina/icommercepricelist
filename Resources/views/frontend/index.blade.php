@extends('iprofile::frontend.layouts.master')
@section('profileBreadcrumb')
    <x-isite::breadcrumb>
        <li class="breadcrumb-item">
            <a href="{{ url('/') }}">{{ trans('core::core.breadcrumb.home') }}</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">{{ trans('icommercepricelist::pricelists.title.pricelists') }}</li>
    </x-isite::breadcrumb>
@endsection

@section('profileTitle')
    {{ trans('icommercepricelist::pricelists.title.pricelists') }}
@endsection
@section('profileContent')
    <div class="w-100 text-right">
        <button class="btn btn-primary" onclick="PrintElement('#priceListContent');">
            <i class="fa fa-file-pdf-o"></i> Descargar
        </button>
    </div>
    <div class="w-100 p-0" id="priceListContent">
        <div class="text-center py-1">
            <x-isite::logo name="logo1" />
            <div class="py-2">
                <div class="d-inline-flex px-1">
                    <x-isite::contact.addresses />
                </div>
                <div class="d-inline-flex px-1">
                    <x-isite::contact.phones />
                </div>
                <div class="d-inline-flex px-1">
                    <x-isite::contact.emails />
                </div>
                <div class="d-inline-flex px-1">
                    <x-isite::whatsapp />
                </div>
            </div>
        </div>
        <div class="card-columns">
            @foreach($categories as $category)
                @if(count($category->ownProducts) > 0)
                <div class="card border-0 m-0">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover m-0">
                                <thead>
                                    <tr>
                                        <td colspan="2" class="text-center bg-primary text-white p-0">
                                            {{ $category->title }}
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($category->ownProducts as $product)
                                    <tr>
                                        <td class="p-0">
                                            <a class="text-primary" href="{{ $product->url }}">{{ $product->name }}</a>
                                        </td>
                                        <td class="text-right p-0">
                                            {{ formatMoney($product->price) }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
        <div class="text-center py-1">
            <x-isite::logo name="logo1" />
            <div class="py-2">
                <div class="d-inline-flex px-1">
                    <x-isite::contact.addresses />
                </div>
                <div class="d-inline-flex px-1">
                    <x-isite::contact.phones />
                </div>
                <div class="d-inline-flex px-1">
                    <x-isite::contact.emails />
                </div>
                <div class="d-inline-flex px-1">
                    <x-isite::whatsapp />
                </div>
            </div>
        </div>
    </div>
@stop

@section('profileExtraFooter')
    @include('icommerce::frontend.partials.extra-footer')
    <script type="text/javascript">
      function PrintElement(element) {
        var data = $(element).html();
        var myWindow = window.open('', '{{ trans('icommercepricelist::pricelists.title.pricelists') }}');
        myWindow.document.write('<html><head><title>{{ trans('icommercepricelist::pricelists.title.pricelists') }}</title>');
        myWindow.document.write('{!! Theme::style('css/main.css?v='.config('app.version')) !!}');
        myWindow.document.write('{!! Theme::style('css/secondary.css?v='.config('app.version')) !!}');
        myWindow.document.write('</head><body >');
        myWindow.document.write(data);
        myWindow.document.write('</body></html>');
        myWindow.document.close(); // necessary for IE >= 10

        myWindow.onload=function(){ // necessary if the div contain images

          myWindow.focus(); // necessary for IE >= 10
          myWindow.print();
          myWindow.close();
        };
      }
    </script>
@endsection
