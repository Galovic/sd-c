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
<!-- Start preloading -->
<div id="loading" class="loading-invisible">
    <div class="loading-center">
        <div class="loading-center-absolute">
            <div class="object" id="object_one"></div>
            <div class="object" id="object_two"></div>
            <div class="object" id="object_three"></div>
            <div class="object" id="object_four"></div>
            <div class="object" id="object_five"></div>
            <div class="object" id="object_six"></div>
            <div class="object" id="object_seven"></div>
            <div class="object" id="object_eight"></div>
            <div class="object" id="object_big"></div>
        </div>
        <p>Načítáme...</p>
    </div>
</div>
<script type="text/javascript">
    document.getElementById("loading").className = "loading-visible";
    var hideDiv = function(){document.getElementById("loading").className = "loading-invisible";};
    var oldLoad = window.onload;
    var newLoad = oldLoad ? function(){hideDiv.call(this);oldLoad.call(this);} : hideDiv;
    window.onload = newLoad;
</script>
<!-- End preloading -->

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
                             style="z-index: 5; white-space: nowrap;">Fresh ideas
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
                             style="z-index: 5; white-space: nowrap;">Sny měníme ve skutečnost
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
                    <h4>Jsme vizionáři a snažíme se brát věci jinak</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 text-center">
                <p>Ač jsme na trhu již deset let, neztratili jsme nic na zápalu v práci. Jako zavedená společnost jsme zodpovědní, ale i tak se umíme do naší práce vrhnout se zápalem na 100 %. A proč právě nás? Protože jsme sehraný tým, který umí táhnout za jeden provaz a vypořádat se i s překážkami, které jiné odradí. Máte představy, ale nevíte, jak s nimi naložit? Obraťte se na nás, protože Vaše sny jsou naší realitou.</p>
            </div>
          {{--  <div class="col-md-4">
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
--}}
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
                    <a><img src="/img/babicka-roku.jpg" class="img-responsive" alt="" /></a>
                    <div class="post-content">
                        <div class="post-date">
                            <span class="date">28</span>
                            <span class="mon-year">Oct 2016</span>
                        </div>
                    {{--    <ul class="post-meta">
                            <li><a><i class="fa fa-user"></i> sd-c.cz</a></li>
                            <li><a href="#"><i class="fa fa-comments"></i> 3</a></li>
                        </ul>--}}
                        <h5><a>Projekt babička roku</a></h5>
                        <br />
                        <a class="btn btn-primary btn-sm">Více</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="post-thumbnails">
                    <a><img src="/img/firemni-akce-2017.jpg" class="img-responsive" alt="" /></a>
                    <div class="post-content">
                        <div class="post-date">
                            <span class="date">28</span>
                            <span class="mon-year">Oct 2016</span>
                        </div>
                        {{--    <ul class="post-meta">
                                <li><a><i class="fa fa-user"></i> sd-c.cz</a></li>
                                <li><a href="#"><i class="fa fa-comments"></i> 3</a></li>
                            </ul>--}}
                        <h5><a>Firemní akce 2017</a></h5>
                        <br />
                        <a class="btn btn-primary btn-sm">Více</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="post-thumbnails">
                    <a><img src="/img/prednasky-pro-seniory.jpg" class="img-responsive" alt="" /></a>
                    <div class="post-content">
                        <div class="post-date">
                            <span class="date">28</span>
                            <span class="mon-year">Oct 2016</span>
                        </div>
                        {{--    <ul class="post-meta">
                                <li><a><i class="fa fa-user"></i> sd-c.cz</a></li>
                                <li><a href="#"><i class="fa fa-comments"></i> 3</a></li>
                            </ul>--}}
                        <h5><a>Přednášky pro seniory</a></h5>

                        <a class="btn btn-primary btn-sm">Více</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End contain wrapper -->


@elseif($_SERVER['REQUEST_URI'] == '/cs/lide')

<div class="contain-wrapp">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 text-center padding-bot60">
                <h1>Lidé</h1>
            </div>
            <div class="col-sm-10 col-sm-offset-1">
                <div class="row padding-bot50">
                    <div class="col-sm-4">
                        <img src="/img/podivinska.png" width="110px" alt="" style="margin-bottom: 10px">
                        <h5>Mgr. Kateřina Podivínská</h5>
                        <span class="cbp-l-project-details-list"><strong>Firemní večírky a akce</strong></span>
                        <p>
                            T: +420 724 838 818<br>
                            E: <a href="mailto:kpodivinska@sundrive.cz">kpodivinska@sundrive.cz</a>
                        </p>
                    </div>
                    <div class="col-sm-4">
                        <img src="/img/hruba.png" width="110px" alt="" style="margin-bottom: 10px">
                        <h5>RNDr. Jana Hrubá</h5>
                        <span class="cbp-l-project-details-list"><strong>Rodinné pasy, reklamní kampaně</strong></span>
                        <p>
                            T: +420 724 831 988<br>
                            E: <a href="mailto:jhruba@sundrive.cz">jhruba@sundrive.cz</a>
                        </p>
                    </div>
                    <div class="col-sm-4">
                        <img src="/img/kreuzerova.png" width="110px" alt="" style="margin-bottom: 10px">
                        <h5>Bc. Marika Kreuzerová</h5>
                        <span class="cbp-l-project-details-list"><strong>Senior Pas, konference</strong></span>
                        <p>
                            T: +420 727 810 558<br>
                            E: <a href="mailto:mkreuzerova@sundrive.cz">mkreuzerova@sundrive.cz</a>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <img src="/img/hornackova.png" width="110px" alt="" style="margin-bottom: 10px">
                        <h5>Marie Horňáčková</h5>
                        <span class="cbp-l-project-details-list"><strong>Senior Pas, konference</strong></span>
                        <p>
                            T: +420 725 590 743<br>
                            E: <a href="mailto:info@sundrive.cz">info@sundrive.cz</a>
                        </p>
                    </div>
                    <div class="col-sm-4">
                        <img src="/img/meduna.png" width="110px" alt="" style="margin-bottom: 10px">
                        <h5>Jiří Meduna</h5>
                        <span class="cbp-l-project-details-list"><strong>Půjčovna</strong></span>
                        <p>
                            T: +420 724 838 788<br>
                            E: <a href="mailto:jmeduna@sundrive.cz">jmeduna@sundrive.cz</a>
                        </p>
                    </div>
                    <div class="col-sm-4">
                        <img src="/img/mikulaskova.png" width="110px" alt="" style="margin-bottom: 10px">
                        <h5>Kateřina Mikulášková Bc.</h5>
                        <span class="cbp-l-project-details-list"><strong>Rodinné pasy</strong></span>
                        <p>
                            T: +420 773 255 747<br>
                            E: <a href="mailto:kmikulaskova@sd-c.cz">kmikulaskova@sd-c.cz</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@elseif($_SERVER['REQUEST_URI'] == '/cs/kontakt')


    <div id="slider_container" class="rev_slider_wrapper">
        <div id="rev-slider" class="rev_slider"  data-version="5.0">
            <ul>
                <li data-transition="slideremovedown">
                    <!-- MAIN IMAGE -->
                    <img src="/img/slider/img09.jpg"  alt=""  width="1920" height="550" />
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
                         style="z-index: 5; white-space: nowrap;">Fresh ideas
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
                         style="z-index: 5; white-space: nowrap;">Sny měníme ve skutečnost
                    </div>
                </li>
            </ul>
        </div><!-- END REVOLUTION SLIDER -->
    </div>

        <!-- Start google map -->
{{--<div class="map-wrapper">
    <div id="map" class="maps"></div>
    <div class="item-map"
         data-lat="-6.921167"
         data-lng="107.610467"
         data-address="Jl. Asia Afrika, Kota Bandung, Jawa Barat, Indonesia">
    </div>
</div>--}}
<!-- End google map -->

<!-- Start contain wrapp -->
<div class="contain-wrapp padding-bot70">
    <div class="container">
        <div class="row padding-bot70">
            <div class="col-sm-12">
                <div class="contact-detail"  style="border:none;">
                    <ul class="list-unstyled">
                        <li style="display:inline-block;float:left;width:33.333%;border:none;">
                            <i class="fa fa-home fa-2x fa-primary"></i>
                            <h6>Kontaktní adresa</h6>
                            <p>
                                Sun Drive Communications, s.r.o.<br />
                                Haraštova 370/22<br />
                                620 00 Brno<br /><br />

                                Web: <a href="http://www.sd-c.cz">www.sd-c.cz</a><br />
                                E-mail: <a href="mailto:info@sd-c.cz">info@sd-c.cz</a><br />
                            </p>
                        </li>
                        <li style="display:inline-block;float:left;width:33.333%;border:none;">
                            <i class="fa fa-home fa-2x fa-primary"></i>
                            <h6>Adresa kanceláře</h6>
                            <p>
                                Sun Drive Communications, s.r.o.<br />
                                Mendlovo náměstí 1a<br />
                                603 00 Brno
                            </p>
                        </li>
                        <li style="display:inline-block;float:left;width:33.333%;border:none;">
                            <i class="fa fa-phone fa-2x fa-primary"></i>
                            <h6>Fakturační údaje</h6>
                            <p>
                                Bankovní spojení: 192281037/0300<br />
                                IČ: 26941007<br />
                                DIČ: CZ26941007<br />
                                Společnost je zapsána v OR, vedeném KS v Brně, oddíl C, vložka 46980<br />
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-sm-offset-2 text-center">
                <h4>Napište nám</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <!-- Start Form -->
                <form method="post" id="mycontactform">
                    <div class="clearfix"></div>
                    <div id="success"></div>
                    <div class="row wrap-form">
                        <div class="form-group col-md-6 col-sm-6">
                            <h6>Celé jméno</h6>
                            <input type="text" name="name" id="name" class="form-control input-lg required" placeholder="Jméno">
                            <span data-for="name" class="error"></span>
                        </div>
                        <div class="form-group col-md-6 col-sm-6">
                            <h6>E-mail</h6>
                            <input type="email" name="email" id="email" class="form-control input-lg required" placeholder="E-mail">
                            <span data-for="email" class="error"></span>
                        </div>
                        <div class="form-group col-md-12">
                            <h6>Zpráva</h6>
                            <textarea name="message" id="message" class="form-control input-lg required" placeholder="Zpráva" rows="9"></textarea>
                            <span data-for="message" class="error"></span>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" value="Odeslat" id="submit" class="btn btn-primary"/>
                            <div class="status-progress"></div>
                        </div>
                    </div>
                </form>
                <!-- End Form -->
            </div>

        </div>
    </div>
</div>
<!-- End contain wrapp -->

@elseif($_SERVER['REQUEST_URI'] == '/cs/pujcovna')

    <div class="contain-wrapp">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text-center padding-bot60">
                    <h1>Půjčovna</h1>
                </div>
                <div class="col-sm-10 col-sm-offset-1 text-center">
                    <p class="lead">
                        Nabízíme k zapůjčení nepřeberné množství sortimentu pro vaše oslavy, firemní akce, svatby, grilovačky či dětské oslavy. Díky našemu sortimentu bude každá vaše akce jedinečná.
                    </p>
                    <a class="btn btn-primary" href="htto://mameakci.cz">Přejít na půjčovnu</a>
                </div>
            </div>
        </div>
    </div>

@endif

<!-- Start footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="widget">
                    <h5>Kontakt</h5>
                    <p>
                        Sun Drive Communications, s.r.o.<br />
                        Haraštova 370/22<br />
                        620 00 Brno<br /><br />

                        Web: <a href="http://www.sd-c.cz">www.sd-c.cz</a><br />
                        E-mail: <a href="mailto:info@sd-c.cz">info@sd-c.cz</a><br />
                    </p>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="widget">
                    <h5>Kancelář</h5>
                    <p>
                        Sun Drive Communications, s.r.o.<br />
                        Mendlovo náměstí 1a<br />
                        603 00 Brno<br />
                    </p>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="widget">
                    <h5>Doporučujeme</h5>
                    <ul class="link-list">
                        <li><a href="http://www.sundrive.cz">Sun Drive</a></li>
                        <li><a href="http://www.sunevents.cz">Sun Events</a></li>
                        <li><a href="http://www.muzeaservis.cz">Muzea Servis</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="subfooter" style="margin: 20px -15px 0 -15px;padding: 20px 0 0 0;">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <p class="copyright">Copyright &copy; 2017<?php if(date('Y') != '2017'){ echo ' - ' . date('Y'); } ?> sd-c.cz Všechna práva vyhrazena.</p>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <ul class="social-network">
                                <li><a href="https://www.facebook.com/SunDriveCommunication/?ref=page_internal"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="mailto:info@sd-c.cz "><i class="fa fa-envelope"></i></a></li>
                                <li><a href="cs/kontakt"><i class="fa fa-phone"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End footer -->


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

@if($_SERVER['REQUEST_URI'] == '/cs/kontakt')
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoRXkZUQLwRTaEF2MymFO5CzuCFBYejMQ"></script>
@endif

</body>
</html>