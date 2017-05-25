<!DOCTYPE html>
<html lang="{{ $data->language->language_code }}">
<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $data->description }}">
    <meta name="keywords" content="{{ $data->keywords }}">
    <meta name="author" content="SIMPLO s.r.o.">
    {{--<link rel="icon" href="../../favicon.ico">--}}

    <title>{{ $data->title }}</title>
    {{ Html::style( $context->elixir('css/style.css') ) }}

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&amp;subset=latin-ext" rel="stylesheet">

    {{-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries --}}
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="/css/template/style.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="/css/template/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- RS5.0 Main Stylesheet -->
    <link rel="stylesheet" type="text/css" href="/css/template/revolution/settings.css">

    <!-- RS5.0 Layers and Navigation Styles -->
    <link rel="stylesheet" type="text/css" href="/css/template/revolution/layers.css">
    <link rel="stylesheet" type="text/css" href="/css/template/revolution/navigation.css">

    <!-- Color -->
    <link id="skin" href="/skins/default.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="/js/template/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/js/template/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/js/template/html5shiv.min.js"></script>
    <script src="/js/template/1.4.2/respond.min.js"></script>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->

</head>
<body>

<header>


    <!-- HOMEPAGE HEADER -->
    <div id="hp-header">
        <!-- NAVBAR -->
    @include('theme::menus.primary')
    <!-- /NAVBAR -->

        @if($_SERVER['REQUEST_URI'] == '/cs')
        <!-- START REVOLUTION SLIDER 5.0 -->
        <div id="slider_container" class="rev_slider_wrapper">
            <div id="rev-slider" class="rev_slider"  data-version="5.0">
                <ul>
                    <li data-transition="slideremovedown">
                        <!-- MAIN IMAGE -->
                        <img src="img/slider/img09.jpg"  alt=""  width="1920" height="550" />
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption rev-text-caption-lg"
                             id="slide-1-layer-1"
                             data-x="left" data-hoffset="135"
                             data-y="top" data-voffset="170"
                             data-width="['auto','auto','auto','auto']"
                             data-height="['auto','auto','auto','auto']"
                             data-transform_idle="o:1;"
                             data-transform_in="y:-50px;opacity:0;s:1500;e:Power3.easeOut;"
                             data-transform_out="y:150px;opacity:0;s:1500;e:Power3.easeOut;"
                             data-start="1500"
                             data-splitin="none"
                             data-splitout="none"
                             data-responsive_offset="on"
                             style="z-index: 5; white-space: nowrap;">Big idea
                        </div>
                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption rev-text-caption-md"
                             id="slide-1-layer-2"
                             data-x="left" data-hoffset="140"
                             data-y="top" data-voffset="310"
                             data-width="['auto','auto','auto','auto']"
                             data-height="['auto','auto','auto','auto']"
                             data-transform_idle="o:1;"
                             data-transform_in="y:-50px;opacity:0;s:1500;e:Power3.easeOut;"
                             data-transform_out="y:150px;opacity:0;s:1500;e:Power3.easeOut;"
                             data-start="2500"
                             data-splitin="none"
                             data-splitout="none"
                             data-responsive_offset="on"
                             style="z-index: 5; white-space: nowrap;">Design for inspirations
                        </div>
                    </li>
                    <li data-transition="slideremovedown">
                        <!-- MAIN IMAGE -->
                        <img src="img/slider/img10.jpg"  alt=""  width="1920" height="550" />
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption rev-text-caption-lg"
                             id="slide-2-layer-1"
                             data-x="left" data-hoffset="135"
                             data-y="top" data-voffset="170"
                             data-width="['auto','auto','auto','auto']"
                             data-height="['auto','auto','auto','auto']"
                             data-transform_idle="o:1;"
                             data-transform_in="y:-50px;opacity:0;s:1500;e:Power3.easeOut;"
                             data-transform_out="y:150px;opacity:0;s:1500;e:Power3.easeOut;"
                             data-start="1500"
                             data-splitin="none"
                             data-splitout="none"
                             data-responsive_offset="on"
                             style="z-index: 5; white-space: nowrap;">Big thing
                        </div>
                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption rev-text-caption-md"
                             id="slide-2-layer-2"
                             data-x="left" data-hoffset="140"
                             data-y="top" data-voffset="310"
                             data-width="['auto','auto','auto','auto']"
                             data-height="['auto','auto','auto','auto']"
                             data-transform_idle="o:1;"
                             data-transform_in="y:-50px;opacity:0;s:1500;e:Power3.easeOut;"
                             data-transform_out="y:150px;opacity:0;s:1500;e:Power3.easeOut;"
                             data-start="2500"
                             data-splitin="none"
                             data-splitout="none"
                             data-responsive_offset="on"
                             style="z-index: 5; white-space: nowrap;">Creative design resources
                        </div>
                    </li>
                    <li data-transition="slideremovedown">
                        <!-- MAIN IMAGE -->
                        <img src="img/slider/img11.jpg"  alt=""  width="1920" height="550" />
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption rev-text-caption-lg"
                             id="slide-3-layer-1"
                             data-x="left" data-hoffset="135"
                             data-y="top" data-voffset="170"
                             data-width="['auto','auto','auto','auto']"
                             data-height="['auto','auto','auto','auto']"
                             data-transform_idle="o:1;"
                             data-transform_in="y:-50px;opacity:0;s:1500;e:Power3.easeOut;"
                             data-transform_out="y:150px;opacity:0;s:1500;e:Power3.easeOut;"
                             data-start="1500"
                             data-splitin="none"
                             data-splitout="none"
                             data-responsive_offset="on"
                             style="z-index: 5; white-space: nowrap;">Big offer
                        </div>
                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption rev-text-caption-md"
                             id="slide-3-layer-2"
                             data-x="left" data-hoffset="140"
                             data-y="top" data-voffset="310"
                             data-width="['auto','auto','auto','auto']"
                             data-height="['auto','auto','auto','auto']"
                             data-transform_idle="o:1;"
                             data-transform_in="y:-50px;opacity:0;s:1500;e:Power3.easeOut;"
                             data-transform_out="y:150px;opacity:0;s:1500;e:Power3.easeOut;"
                             data-start="2500"
                             data-splitin="none"
                             data-splitout="none"
                             data-responsive_offset="on"
                             style="z-index: 5; white-space: nowrap;">For your own custom design
                        </div>
                    </li>
                </ul>
            </div><!-- END REVOLUTION SLIDER -->
        </div>
        <!-- END OF SLIDER WRAPPER -->
        @endif
    </div>
    <!-- /HOMEPAGE HEADER -->
</header>

@yield('content')
@if($_SERVER['REQUEST_URI'] == '/cs')
        <!-- Start contain wrapp -->
<div class="contain-wrapp gray-container padding-bot50">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title-head centered">
                   {{-- <span>Features</span>--}}
                    <h4>Proč my</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="col-icon absolute-left">
                    <i class="fa fa-tablet fa-primary"></i>
                    <h5>Komplexní marketingové služby</h5>
                    <p>
                        Zajišťujeme také komplexní marketingové služby od analýzy potřeb, přípravy strategie až po samotnou realizaci marketingové kampaně včetně jejího vyhodnocení. Několik let provozujeme celostátní slevové sítě se zaměřením na rodiny a seniory.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="col-icon absolute-left">
                    <i class="fa fa-magic fa-primary"></i>
                    <h5>Spolehlivost</h5>
                    <p>
                        Řídíme se hodnotami jako je spolehlivost, tvořivost a motivace kontinuálně se učit a zlepšovat. Při vlastních projektech promýšlíme i rozměr společenské prospěšnosti a pokud je možnost i přímé sociální pomoci.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="col-icon absolute-left">
                    <i class="fa fa-code fa-primary"></i>
                    <h5>Tvořivost</h5>
                    <p>
                        Řídíme se hodnotami jako je spolehlivost, tvořivost a motivace kontinuálně se učit a zlepšovat. Při vlastních projektech promýšlíme i rozměr společenské prospěšnosti a pokud je možnost i přímé sociální pomoci.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="col-icon absolute-left">
                    <i class="fa fa-gift fa-primary"></i>
                    <h5>Praxe</h5>
                    <p>
                        Na trhu se pohybujeme přes 10 let a můžete se seznámit s našimi výsledky.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="col-icon absolute-left">
                    <i class="fa fa-tablet fa-primary"></i>
                    <h5>Komplexní marketingové služby</h5>
                    <p>
                        Zajišťujeme také komplexní marketingové služby od analýzy potřeb, přípravy strategie až po samotnou realizaci marketingové kampaně včetně jejího vyhodnocení. Několik let provozujeme celostátní slevové sítě se zaměřením na rodiny a seniory.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="col-icon absolute-left">
                    <i class="fa fa-magic fa-primary"></i>
                    <h5>Spolehlivost</h5>
                    <p>
                        Řídíme se hodnotami jako je spolehlivost, tvořivost a motivace kontinuálně se učit a zlepšovat. Při vlastních projektech promýšlíme i rozměr společenské prospěšnosti a pokud je možnost i přímé sociální pomoci.
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End contain wrapp -->


<!-- Start contain wrapper -->
<div class="contain-wrapp padding-bot60">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="title-head centered">
                    <span>Novinky</span>
                    <h4>Poslední příspěvky</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="post-thumbnails">
                    <a href="#"><img src="/img/blog/img01.jpg" class="img-responsive" alt="" /></a>
                    <div class="post-content">
                        <div class="post-date">
                            <span class="date">28</span>
                            <span class="mon-year">Oct 2016</span>
                        </div>
                        <ul class="post-meta">
                            <li><a href="#"><i class="fa fa-user"></i> 99webpage</a></li>
                            <li><a href="#"><i class="fa fa-comments"></i> 3</a></li>
                        </ul>
                        <h5><a href="#">Pri nobis dissentiet perse queris assum.</a></h5>
                        <a href="#" class="btn btn-primary btn-sm">Read more</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="post-thumbnails">
                    <a href="#"><img src="/img/blog/img02.jpg" class="img-responsive" alt="" /></a>
                    <div class="post-content">
                        <div class="post-date">
                            <span class="date">24</span>
                            <span class="mon-year">Oct 2016</span>
                        </div>
                        <ul class="post-meta">
                            <li><a href="#"><i class="fa fa-user"></i> 99webpage</a></li>
                            <li><a href="#"><i class="fa fa-comments"></i> 3</a></li>
                        </ul>
                        <h5><a href="#">Graece scipit consul efficiantur duo at.</a></h5>
                        <a href="#" class="btn btn-primary btn-sm">Read more</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="post-thumbnails">
                    <a href="#"><img src="/img/blog/img03.jpg" class="img-responsive" alt="" /></a>
                    <div class="post-content">
                        <div class="post-date">
                            <span class="date">20</span>
                            <span class="mon-year">Oct 2016</span>
                        </div>
                        <ul class="post-meta">
                            <li><a href="#"><i class="fa fa-user"></i> 99webpage</a></li>
                            <li><a href="#"><i class="fa fa-comments"></i> 3</a></li>
                        </ul>
                        <h5><a href="#">Sit ne harum cu vel impetus postulant.</a></h5>
                        <a href="#" class="btn btn-primary btn-sm">Read more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End contain wrapper -->
@endif


<!-- Start footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-6">
                <div class="widget">
                    <ul class="link-list">
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Meet team</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Help</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-6">
                <div class="widget">
                    <ul class="link-list">
                        <li><a href="#">Themes</a></li>
                        <li><a href="#">Free resources</a></li>
                        <li><a href="#">Logi design</a></li>
                        <li><a href="#">UI/UX PSD</a></li>
                        <li><a href="#">Graphic</a></li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="subfooter">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <p class="copyright">2016 &copy; Copyright sd-c.cz Všechna práva vyhrazena.</p>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <ul class="social-network">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End footer -->
{{--

<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                <button class="pswp__button pswp__button--share" title="Share"></button>
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>
            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>
--}}



{{ Html::script( $context->elixir('js/app.js') ) }}

@stack('scripts')

<script src="http://tutsplus.github.io/photoswipe-jquery/js/photoswipe.min.js"></script>
<script src="http://tutsplus.github.io/photoswipe-jquery/js/photoswipe-ui-default.min.js"></script>
<!-- Bootstrap core JavaScript
  ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/js/template/jquery.min.js"></script>
<script src="/js/template/bootstrap.min.js"></script>
<script src="/js/template/bootsnav.js"></script>
<script src="/js/template/jquery.easing-1.3.min.js"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/js/template/ie10-viewport-bug-workaround.js"></script>

<!-- REVOLUTION JS FILES -->
<script type="text/javascript" src="/js/template/revolution/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="/js/template/revolution/jquery.themepunch.revolution.min.js"></script>

<!-- SLIDER REVOLUTION 5.0 EXTENSIONS
(Load Extensions only on Local File Systems !
The following part can be removed on Server for On Demand Loading) -->
<script type="text/javascript" src="/js/template/revolution/revolution.extension.actions.min.js"></script>
<script type="text/javascript" src="/js/template/revolution/revolution.extension.carousel.min.js"></script>
<script type="text/javascript" src="/js/template/revolution/revolution.extension.kenburn.min.js"></script>
<script type="text/javascript" src="/js/template/revolution/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="/js/template/revolution/revolution.extension.migration.min.js"></script>
<script type="text/javascript" src="/js/template/revolution/revolution.extension.navigation.min.js"></script>
<script type="text/javascript" src="/js/template/revolution/revolution.extension.parallax.min.js"></script>
<script type="text/javascript" src="/js/template/revolution/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="/js/template/revolution/revolution.extension.video.min.js"></script>

<!-- CUSTOM REVOLUTION JS FILES -->
<script type="text/javascript" src="/js/template/revolution/setting/creative-slide.js"></script>

<!-- Custom form -->
<script src="/js/template/form/jcf.js"></script>
<script src="/js/template/form/jcf.scrollable.js"></script>
<script src="/js/template/form/jcf.select.js"></script>

<!-- Custom checkbox and radio -->
<script src="/js/template/checkator/fm.checkator.jquery.js"></script>
<script src="/js/template/checkator/setting.js"></script>

<!-- Custom input file -->
<script src="/js/template/custominput/modernizr.js"></script>
<script src="/js/template/custominput/custom-file-input.js"></script>

<!-- Cube portfolio -->
<script src="/js/template/cubeportfolio/jquery.cubeportfolio.min.js"></script>
<script src="/js/template/cubeportfolio/masonry.js"></script>

<!-- owl carousel -->
<script src="/js/template/owlcarousel/owl.carousel.min.js"></script>
<script src="/js/template/owlcarousel/setting.js"></script>

<!-- Twitter -->
<script src="/js/template/twitter/tweetie.min.js"></script>
<script src="/js/template/twitter/ticker.js"></script>
<script src="/js/template/twitter/setting.js"></script>

<!-- Custom -->
<script src="/js/template/custom.js"></script>

</body>
</html>