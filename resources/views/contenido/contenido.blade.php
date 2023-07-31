@extends('principal')

@section('styles')
    <style>
        #container-fluid {
            background: #1a74bc;
            color: #fff;
            padding-bottom: 0px;
            {{-- margin-left:32px; --}}
        }

        svg {
            {{-- margin-left: 32px; --}} margin-top: -5px;
        }

        .btn-white {
            border-radius: 8px;
        }
    </style>
    <style>
        .card {
            border: none;
            padding: 10px;
            display: inline-block;
        }

        .card:hover {
            box-shadow: inset 0 0 10px 0 rgba(0, 0, 0, 0.3);
            cursor: pointer;
            transition: 1s;
        }

        /*
                        code by Iatek LLC 2018 - CC 2.0 License - Attribution required
                        code customized by Azmind.com
                    */
        @media (min-width: 768px) and (max-width: 991px) {

            /* Show 4th slide on md if col-md-4*/
            .carousel-inner .active.col-md-4.carousel-item+.carousel-item+.carousel-item+.carousel-item {
                position: absolute;
                top: 0;
                right: -33.3333%;
                /*change this with javascript in the future*/
                z-index: -1;
                display: block;
                visibility: visible;
            }
        }

        @media (min-width: 576px) and (max-width: 768px) {

            /* Show 3rd slide on sm if col-sm-6*/
            .carousel-inner .active.col-sm-6.carousel-item+.carousel-item+.carousel-item {
                position: absolute;
                top: 0;
                right: -50%;
                /*change this with javascript in the future*/
                z-index: -1;
                display: block;
                visibility: visible;
            }
        }

        @media (min-width: 576px) {
            .carousel-item {
                margin-right: 0;
            }

            /* show 2 items */
            .carousel-inner .active+.carousel-item {
                display: block;
            }

            .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left),
            .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left)+.carousel-item {
                transition: none;
            }

            .carousel-inner .carousel-item-next {
                position: relative;
                transform: translate3d(0, 0, 0);
            }

            /* left or forward direction */
            .active.carousel-item-left+.carousel-item-next.carousel-item-left,
            .carousel-item-next.carousel-item-left+.carousel-item,
            .carousel-item-next.carousel-item-left+.carousel-item+.carousel-item {
                position: relative;
                transform: translate3d(-100%, 0, 0);
                visibility: visible;
            }

            /* farthest right hidden item must be also positioned for animations */
            .carousel-inner .carousel-item-prev.carousel-item-right {
                position: absolute;
                top: 0;
                left: 0;
                z-index: -1;
                display: block;
                visibility: visible;
            }

            /* right or prev direction */
            .active.carousel-item-right+.carousel-item-prev.carousel-item-right,
            .carousel-item-prev.carousel-item-right+.carousel-item,
            .carousel-item-prev.carousel-item-right+.carousel-item+.carousel-item {
                position: relative;
                transform: translate3d(100%, 0, 0);
                visibility: visible;
                display: block;
                visibility: visible;
            }
        }

        /* MD */
        @media (min-width: 768px) {

            /* show 3rd of 3 item slide */
            .carousel-inner .active+.carousel-item+.carousel-item {
                display: block;
            }

            .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left)+.carousel-item+.carousel-item {
                transition: none;
            }

            .carousel-inner .carousel-item-next {
                position: relative;
                transform: translate3d(0, 0, 0);
            }

            /* left or forward direction */
            .carousel-item-next.carousel-item-left+.carousel-item+.carousel-item+.carousel-item {
                position: relative;
                transform: translate3d(-100%, 0, 0);
                visibility: visible;
            }

            /* right or prev direction */
            .carousel-item-prev.carousel-item-right+.carousel-item+.carousel-item+.carousel-item {
                position: relative;
                transform: translate3d(100%, 0, 0);
                visibility: visible;
                display: block;
                visibility: visible;
            }
        }

        /* LG */
        @media (min-width: 991px) {

            /* show 4th item */
            .carousel-inner .active+.carousel-item+.carousel-item+.carousel-item {
                display: block;
            }

            .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left)+.carousel-item+.carousel-item+.carousel-item {
                transition: none;
            }

            /* Show 5th slide on lg if col-lg-3 */
            .carousel-inner .active.col-lg-3.carousel-item+.carousel-item+.carousel-item+.carousel-item+.carousel-item {
                position: absolute;
                top: 0;
                right: -25%;
                /*change this with javascript in the future*/
                z-index: -1;
                display: block;
                visibility: visible;
            }

            /* left or forward direction */
            .carousel-item-next.carousel-item-left+.carousel-item+.carousel-item+.carousel-item+.carousel-item {
                position: relative;
                transform: translate3d(-100%, 0, 0);
                visibility: visible;
            }

            /* right or prev direction //t - previous slide direction last item animation fix */
            .carousel-item-prev.carousel-item-right+.carousel-item+.carousel-item+.carousel-item+.carousel-item {
                position: relative;
                transform: translate3d(100%, 0, 0);
                visibility: visible;
                display: block;
                visibility: visible;
            }
        }
    </style>
@endsection

@section('contenido')

    @if (Auth::user()->idrol == 1)
        <template v-if="menu==0">
            <main class="main">
                @include('contenido.escritorio')
            </main>
        </template>
        <template v-if="menu==1">
            <region></region>
        </template>
        <template v-if="menu==2">
            <municipalities></municipalities>
        </template>
        <template v-if="menu==3">
            <ports></ports>
        </template>
        <template v-if="menu==4">
            <autofisher></autofisher>
        </template>
        <template v-if="menu==5">
            <flags></flags>
        </template>
        <template v-if="menu==6">
            <docks></docks>
        </template>
        <template v-if="menu==7">
            <zarpe></zarpe>
        </template>
        <template v-if="menu==8">
            <arrival></arrival>
        </template>
        <template v-if="menu==9">
            <checkdetinch></checkdetinch>
        </template>
        <template v-if="menu==10">
            <checkdetflap></checkdetflap>
        </template>
        <template v-if="menu==11">
            <presenVerific></presenVerific>
        </template>
        <template v-if="menu==12">
            <nationality></nationality>
        </template>
        <template v-if="menu==13">
            <companies></companies>
        </template>
        <template v-if="menu==14">
            <donations></donations>
        </template>
        <template v-if="menu==15">
            <confiscations></confiscations>
        </template>
        <template v-if="menu==16">
            <inspectioncargos></inspectioncargos>
        </template>
        <template v-if="menu==17">
            <certificationtuna></certificationtuna>
        </template>
        <template v-if="menu==18">
            <materials></materials>
        </template>
        <template v-if="menu==20">
            <boats></boats>
        </template>
        <template v-if="menu==21">
            <user></user>
        </template>
        <template v-if="menu==22">
            <perfil></perfil>
        </template>
    @else
        <template v-if="menu==0">
            <main class="main">
                @include('contenido.escritorio')
            </main>
        </template>
        <template v-if="menu==1">
            <region></region>
        </template>
        <template v-if="menu==2">
            <municipalities></municipalities>
        </template>
        <template v-if="menu==3">
            <ports></ports>
        </template>
        <template v-if="menu==4">
            <autofisher></autofisher>
        </template>
        <template v-if="menu==5">
            <flags></flags>
        </template>
        <template v-if="menu==6">
            <docks></docks>
        </template>
        <template v-if="menu==7">
            <zarpe></zarpe>
        </template>
        <template v-if="menu==8">
            <arrival></arrival>
        </template>
        <template v-if="menu==9">
            <checkdetinch></checkdetinch>
        </template>
        <template v-if="menu==10">
            <checkdetflap></checkdetflap>
        </template>
        <template v-if="menu==11">
            <presenVerific></presenVerific>
        </template>
        <template v-if="menu==12">
            <nationality></nationality>
        </template>
        <template v-if="menu==13">
            <companies></companies>
        </template>
        <template v-if="menu==14">
            <donations></donations>
        </template>
        <template v-if="menu==15">
            <confiscations></confiscations>
        </template>
        <template v-if="menu==16">
            <inspectioncargos></inspectioncargos>
        </template>
        <template v-if="menu==17">
            <certificationtuna></certificationtuna>
        </template>
        <template v-if="menu==18">
            <materials></materials>
        </template>
        <template v-if="menu==20">
            <boats></boats>
        </template>
        <template v-if="menu==21">
            <user></user>
        </template>
        <template v-if="menu==22">
            <perfil></perfil>
        </template>
    @endif


@endsection

@section('scripts')
    <script>
        $('#carousel-example').on('slide.bs.carousel', function(e) {
            /*
                CC 2.0 License Iatek LLC 2018 - Attribution required
            */
            var $e = $(e.relatedTarget);
            var idx = $e.index();
            var itemsPerSlide = 5;
            var totalItems = $('.carousel-item').length;

            if (idx >= totalItems - (itemsPerSlide - 1)) {
                var it = itemsPerSlide - (totalItems - idx);
                for (var i = 0; i < it; i++) {
                    // append slides to end
                    if (e.direction == "left") {
                        $('.carousel-item').eq(i).appendTo('.carousel-inner');
                    } else {
                        $('.carousel-item').eq(0).appendTo('.carousel-inner');
                    }
                }
            }
        });
    </script>
@endsection
