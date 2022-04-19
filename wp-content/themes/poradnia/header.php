<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
<script src="/wp-content/themes/poradnia/assets/js/cookiesconsent.min-min.js"></script>
    <script>
        window.CookieConsent.init({
            modalMainTextMoreLink: null,
            barTimeout: 1000,
            theme: {
                barColor: '#CF6187',
                barTextColor: '#FFF',
                barMainButtonColor: '#FFF',
                barMainButtonTextColor: '#CF6187',
                modalMainButtonColor: '#CF6187',
                modalMainButtonTextColor: '#FFF',
            },
            language: {
                current: 'pl',
                locale: {
                    pl: {
                        barMainText: 'Administratorem Twoich danych osobowych jest Poradnia Laktacyjna Mataja i będą one przetwarzane przede wszystkim w celu realizacji Twojego zapytania. Więcej informacji o swoich prawach oraz o celach przetwarzania danych znajdziesz w Polityce prywatności i plików cookies. ',
                        barLinkSetting: 'Zaakceptuj wybrane',
                        barBtnAcceptAll: 'Zaakceptuj wszystkie',
                        modalMainTitle: 'Ustawienia plików cookies',
                        modalMainText: '',
                        modalBtnSave: 'Zapisz ustawienia',
                        modalBtnAcceptAll: 'Zaakceptuj wszystkie ciasteczka i zamknij',
                        modalAffectedSolutions: 'Używane rozwiązania:',
                        learnMore: 'Dowiedz się więcej',
                        on: 'Wł',
                        off: 'Wył',
                    }
                }
            },
            categories: {
                necessary: {
                    needed: true,
                    wanted: true,
                    checked: true,
                    language: {
                        locale: {
                            pl: {
                                name: 'Cookies niezbędne',
                                description: 'Służą do prawidłowego funkcjonowania strony internetowej. Pliki te pomagają nam zapamiętać wybrane przez użytkownika ustawienia strony, czy też pomagają przy innych funkcjach podczas przeglądania i korzystania z witryny.',
                            }
                        }
                    }
                },
                analytics: {
                    needed: false,
                    wanted: false,
                    checked: false,
                    language: {
                        locale: {
                            pl: {
                                name: 'Cookies funkcjonalne',
                                description: 'Służą do pomiaru aktywności podczas przeglądania strony, aby dowiedzieć się w jaki sposób jest ona wykorzystywana. Dzięki nim możemy mierzyć efektywność naszych działań marketingowych bez identyfikacji danych osobowych oraz ulepszać funkcjonowanie strony internetowej.'
                            }
                        }
                    }
                },
                marketing: {
                    needed: false,
                    wanted: false,
                    checked: false,
                    language: {
                        locale: {
                            pl: {
                                name: 'Cookies reklamowe',
                                description: 'Służą do wyświetlania reklam odpowiednich dla zainteresowań danego użytkownika. Służą one również do ograniczenia liczby wyświetleń danej reklamy oraz pomiaru skuteczności kampanii reklamowej. Dzięki nim możliwe jest przekazanie użytkownikowi tylko tych informacji, którymi aktualnie jest zainteresowany'
                            }
                        }
                    }
                }
            },
            services: {

                analytics: {
                    category: 'analytics',
                    type: 'dynamic-script',
                    search: 'analytics',
                    cookies: [
                        {
                            name: '/^_ga/',
                            domain: `.${window.location.hostname}`
                        },
                        {
                            name: '_gid',
                            domain: `.${window.location.hostname}`
                        },
                        {
                            name: '_gat_',
                            domain: `.${window.location.hostname}`
                        },
                        {
                            name: '_gat_*',
                            domain: `.${window.location.hostname}`
                        },
                        {
                            name: '_dc_gtm_',
                            domain: `.${window.location.hostname}`
                        },
                        {
                            name: 'AMP_TOKEN',
                            domain: `.${window.location.hostname}`
                        },
                        {
                            name: '__utma',
                            domain: `.${window.location.hostname}`
                        },
                        {
                            name: '__utmt',
                            domain: `.${window.location.hostname}`
                        },
                        {
                            name: '__utmb',
                            domain: `.${window.location.hostname}`
                        },
                        {
                            name: '__utmc',
                            domain: `.${window.location.hostname}`
                        },
                        {
                            name: '__utmz',
                            domain: `.${window.location.hostname}`
                        },
                        {
                            name: 'HSID',
                            domain: `.${window.location.hostname}`
                        },
                        {
                            name: 'SSID',
                            domain: `.${window.location.hostname}`
                        },
                        {
                            name: 'APISID',
                            domain: `.${window.location.hostname}`
                        },
                        {
                            name: 'SAPISID',
                            domain: `.${window.location.hostname}`
                        },
                        {
                            name: 'SIDCC',
                            domain: `.${window.location.hostname}`
                        },
                    ],
                    language: {
                        locale: {
                            pl: {
                                name: 'Google Analytics'
                            }
                        }
                    }
                },
                analytics1: {
                    category: 'marketing',
                    type: 'dynamic-script',
                    search: 'analytics1',
                    cookies: [
                        {
                            name: '_gac_*',
                            domain: `.${window.location.hostname}`
                        },
                        {
                            name: 'APISID',
                            domain: `.${window.location.hostname}`
                        },
                        {
                            name: 'NID',
                            domain: `.${window.location.hostname}`
                        },
                        {
                            name: 'SID',
                            domain: `.${window.location.hostname}`
                        },
                        {
                            name: '1P_JAR',
                            domain: `.${window.location.hostname}`
                        },
                        {
                            name: '_gcl_au',
                            domain: `.${window.location.hostname}`
                        },
                    ],
                    language: {
                        locale: {
                            pl: {
                                name: 'Google Analytics'
                            }
                        }
                    }
                }
            }
        });
    </script>
    <meta name="theme-color" content="#CF6187">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="profile" href="https://gmpg.org/xfn/11"/>
    <link rel="icon" type="image/png" href="/wp-content/themes/poradnia/img/fav.png"/>
    <?php wp_head();?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-RQ98Q32NT3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-RQ98Q32NT3');
</script>

<!-- Meta Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '372790067704494');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=372790067704494&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
</head>

<body <?php body_class(); ?> >

<section class="nav nav-rest">
   <div class="container container__big">
        <a href="/" class="nav__logo">
           <img src="/wp-content/themes/poradnia/img/logo.svg" alt="Poradnia Laktacyjna Mataja" width="260" height="95" />
        </a>
        <nav class="nav__menu">
            <?php wp_nav_menu( array('theme_location' => 'my-menu') );  ;?>
        </nav>
        <div class="nav__btn">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <?php echo do_shortcode("[woo_cart_but]"); ?>
   </div>
</section>

<main>