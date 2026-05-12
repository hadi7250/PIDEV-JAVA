<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* forum/index.html.twig */
class __TwigTemplate_0ba4321c9a2b76421d07d26713dcd4dd extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "forum/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "forum/index.html.twig"));

        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Forum - ";
        yield from $this->yieldParentBlock("title", $context, $blocks);
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        yield "<div class=\"page-wrapper\">
    <!-- Preloader -->
    <div class=\"loader-wrap\">
        <div class=\"preloader\">
            <div class=\"preloader-close\">x</div>
            <div id=\"handle-preloader\" class=\"handle-preloader\">
                <div class=\"animation-preloader\">
                    <div class=\"txt-loading\">
                        <span data-text-preloader=\"F\" class=\"letters-loading\">F</span>
                        <span data-text-preloader=\"O\" class=\"letters-loading\">O</span>
                        <span data-text-preloader=\"R\" class=\"letters-loading\">R</span>
                        <span data-text-preloader=\"U\" class=\"letters-loading\">U</span>
                        <span data-text-preloader=\"M\" class=\"letters-loading\">M</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class=\"main-header header-style-one\">
        <div class=\"header-lower\">
            <div class=\"auto-container\">
                <div class=\"inner-container\">
                    <div class=\"d-flex justify-content-between align-items-center flex-wrap\">
                        
                        <div class=\"logo-box\">
                            <div class=\"logo\"><a href=\"";
        // line 33
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_homepage");
        yield "\"><img src=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/logo.svg"), "html", null, true);
        yield "\" alt=\"\" title=\"\"></a></div>
                        </div>
                        
                        <div class=\"nav-outer d-flex flex-wrap\">
                            <!-- Main Menu -->
                            <nav class=\"main-menu navbar-expand-md\">
                                <div class=\"navbar-header\">
                                    <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                                        <span class=\"icon-bar\"></span>
                                        <span class=\"icon-bar\"></span>
                                        <span class=\"icon-bar\"></span>
                                    </button>
                                </div>
                                
                                <div class=\"navbar-collapse collapse clearfix\" id=\"navbarSupportedContent\">
                                    <ul class=\"navigation clearfix\">
                                        <li><a href=\"";
        // line 49
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_homepage");
        yield "\">Home</a></li>
                                        <li class=\"current\"><a href=\"";
        // line 50
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_index");
        yield "\">Forum</a></li>
                                        <li><a href=\"#\">About</a></li>
                                        <li><a href=\"#\">Contact</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>

                        <!-- Main Menu End-->
                        <div class=\"outer-box d-flex align-items-center flex-wrap\">
                            ";
        // line 60
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 60, $this->source); })()), "user", [], "any", false, false, false, 60)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 61
            yield "                                <span class=\"welcome-text\">Welcome, ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::default(Twig\Extension\CoreExtension::trim(((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 61, $this->source); })()), "user", [], "any", false, false, false, 61), "firstName", [], "any", false, false, false, 61) . " ") . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 61, $this->source); })()), "user", [], "any", false, false, false, 61), "lastName", [], "any", false, false, false, 61))), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 61, $this->source); })()), "user", [], "any", false, false, false, 61), "email", [], "any", false, false, false, 61)), "html", null, true);
            yield "</span>
                                
                                <!-- Notification Bell -->
                                <div class=\"notification-dropdown\">
                                    <button type=\"button\" class=\"notification-bell\" id=\"notificationBell\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                                        <i class=\"fa fa-bell\"></i>
                                        <span class=\"notification-badge\" id=\"notificationBadge\" style=\"display: none;\">0</span>
                                    </button>
                                    <ul class=\"dropdown-menu dropdown-menu-end notification-menu\" id=\"notificationMenu\" style=\"background: rgba(0,0,0,0.9); border: 1px solid rgba(255,255,255,0.2); min-width: 300px; max-height: 400px; overflow-y: auto;\">
                                        <li class=\"dropdown-header text-white\">Notifications</li>
                                        <li><hr class=\"dropdown-divider\"></li>
                                        <li id=\"notificationList\">
                                            <div class=\"text-center text-white-50 p-3\">
                                                <i class=\"fa fa-bell-slash fa-2x mb-2\"></i>
                                                <p>No new notifications</p>
                                            </div>
                                        </li>
                                        <li><hr class=\"dropdown-divider\"></li>
                                        <li>
                                            <a href=\"#\" class=\"dropdown-item text-white\" id=\"markAllReadBtn\">Mark all as read</a>
                                        </li>
                                    </ul>
                                </div>
                                
                                <a href=\"";
            // line 85
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_new_discussion");
            yield "\" class=\"template-btn btn-style-one\">
                                    <span class=\"btn-wrap\">
                                        <span class=\"text-one\">New Discussion</span>
                                        <span class=\"text-two\">New Discussion</span>
                                    </span>
                                </a>
                                <a href=\"";
            // line 91
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
            yield "\" class=\"template-btn btn-style-two\">
                                    <span class=\"btn-wrap\">
                                        <span class=\"text-one\">Logout</span>
                                        <span class=\"text-two\">Logout</span>
                                    </span>
                                </a>
                            ";
        } else {
            // line 98
            yield "                                <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
            yield "\" class=\"template-btn btn-style-two\">
                                    <span class=\"btn-wrap\">
                                        <span class=\"text-one\">Login</span>
                                        <span class=\"text-two\">Login</span>
                                    </span>
                                </a>
                                <a href=\"";
            // line 104
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
            yield "\" class=\"template-btn btn-style-one\">
                                    <span class=\"btn-wrap\">
                                        <span class=\"text-one\">Join now</span>
                                        <span class=\"text-two\">Join now</span>
                                    </span>
                                </a>
                            ";
        }
        // line 111
        yield "                        </div>

                        <!-- Mobile Navigation Toggler -->
                        <div class=\"mobile-nav-toggler\">
                            <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon icon-tabler icon-tabler-menu-2\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"1.5\" stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"/><path d=\"M4 6l16 0\" /><path d=\"M4 12l16 0\" /><path d=\"M4 18l16 0\" /></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Forum Content -->
    <section class=\"forum-section\" style=\"padding: 120px 0 80px 0;\">
        <div class=\"auto-container\">
            <!-- Page Title -->
            <div class=\"sec-title centered mb-5\">
                <div class=\"sec-title_title\">Community Forum</div>
                <h2 class=\"sec-title_heading\">Join the <span>Discussion</span></h2>
            </div>

            <!-- Search Bar -->
            <div class=\"search-box mb-5\">
                <form action=\"";
        // line 134
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_search");
        yield "\" method=\"GET\" class=\"d-flex\">
                    <input type=\"text\" name=\"q\" class=\"form-control\" placeholder=\"Search discussions...\" style=\"background: white; color: #333; border: 1px solid #ddd;\">
                    <button type=\"submit\" class=\"template-btn btn-style-one ms-2\">
                        <span class=\"btn-wrap\">
                            <span class=\"text-one\">Search</span>
                            <span class=\"text-two\">Search</span>
                        </span>
                    </button>
                </form>
            </div>

            <div class=\"row\">
                <!-- Main Content -->
                <div class=\"col-lg-8\">
                    <!-- Categories Grid -->
                    <div class=\"row\">
                        ";
        // line 150
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["categories"]) || array_key_exists("categories", $context) ? $context["categories"] : (function () { throw new RuntimeError('Variable "categories" does not exist.', 150, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["categoryData"]) {
            // line 151
            yield "                            <div class=\"col-lg-4 col-md-6 mb-4\">
                                <div class=\"forum-category-card\" style=\"background: rgba(255,255,255,0.1); border-radius: 15px; padding: 25px; border: 1px solid rgba(255,255,255,0.2); backdrop-filter: blur(10px); transition: all 0.3s ease;\">
                                    <div class=\"category-icon mb-3\">
                                        <i class=\"fa fa-comments fa-3x\" style=\"color: #667eea;\"></i>
                                    </div>
                                    <h4 class=\"category-title\" style=\"color: white; margin-bottom: 10px;\">";
            // line 156
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["categoryData"], "name", [], "any", false, false, false, 156), "html", null, true);
            yield "</h4>
                                    <p class=\"category-description\" style=\"color: rgba(255,255,255,0.7); margin-bottom: 15px;\">";
            // line 157
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, $context["categoryData"], "description", [], "any", true, true, false, 157)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["categoryData"], "description", [], "any", false, false, false, 157), "No description available")) : ("No description available")), "html", null, true);
            yield "</p>
                                    <div class=\"category-stats\" style=\"color: rgba(255,255,255,0.6); font-size: 14px;\">
                                        <i class=\"fa fa-comments\"></i> ";
            // line 159
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["categoryData"], "discussionCount", [], "any", false, false, false, 159), "html", null, true);
            yield " discussions
                                    </div>
                                    <div class=\"category-link\">
                                        <a href=\"";
            // line 162
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_category", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["categoryData"], "id", [], "any", false, false, false, 162)]), "html", null, true);
            yield "\" class=\"template-btn btn-style-two\">
                                            <span class=\"btn-wrap\">
                                                <span class=\"text-one\">View Category</span>
                                                <span class=\"text-two\">View Category</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        ";
            $context['_iterated'] = true;
        }
        // line 171
        if (!$context['_iterated']) {
            // line 172
            yield "                            <div class=\"col-12\">
                                <div class=\"text-center\" style=\"color: white;\">
                                    <i class=\"fa fa-folder-open fa-4x mb-3\" style=\"color: rgba(255,255,255,0.5);\"></i>
                                    <h3>No categories yet</h3>
                                    <p>Be the first to start a discussion!</p>
                                </div>
                            </div>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['categoryData'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 180
        yield "                    </div>

                    <!-- Recent Discussions -->
                    ";
        // line 183
        if ((($tmp = (isset($context["recentDiscussions"]) || array_key_exists("recentDiscussions", $context) ? $context["recentDiscussions"] : (function () { throw new RuntimeError('Variable "recentDiscussions" does not exist.', 183, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 184
            yield "                        <div class=\"recent-discussions mt-5\">
                            <h3 class=\"text-white mb-4\">Recent Discussions</h3>
                            <div class=\"row\">
                                ";
            // line 187
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["recentDiscussions"]) || array_key_exists("recentDiscussions", $context) ? $context["recentDiscussions"] : (function () { throw new RuntimeError('Variable "recentDiscussions" does not exist.', 187, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["discussion"]) {
                // line 188
                yield "                                    <div class=\"col-lg-6 mb-3\">
                                        <div class=\"discussion-card\" style=\"background: rgba(255,255,255,0.05); border-radius: 10px; padding: 20px; border: 1px solid rgba(255,255,255,0.1);\">
                                            <h5 class=\"discussion-title\" style=\"color: white; margin-bottom: 10px;\">
                                                <a href=\"";
                // line 191
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_discussion", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "id", [], "any", false, false, false, 191)]), "html", null, true);
                yield "\" style=\"color: white; text-decoration: none;\">
                                                    ";
                // line 192
                yield (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "title", [], "any", false, false, false, 192)) > 50)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "title", [], "any", false, false, false, 192), 0, 50) . "..."), "html", null, true)) : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "title", [], "any", false, false, false, 192), "html", null, true)));
                yield "
                                                </a>
                                            </h5>
                                            <div class=\"discussion-meta\" style=\"color: rgba(255,255,255,0.6); font-size: 12px; margin-bottom: 10px;\">
                                                <i class=\"fa fa-user\"></i> ";
                // line 196
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "authorName", [], "any", false, false, false, 196), "html", null, true);
                yield "
                                                <span class=\"ms-2\"><i class=\"fa fa-clock\"></i> ";
                // line 197
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "createdAt", [], "any", false, false, false, 197), "M d, Y H:i"), "html", null, true);
                yield "</span>
                                                <span class=\"ms-2\"><i class=\"fa fa-eye\"></i> ";
                // line 198
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "views", [], "any", false, false, false, 198), "html", null, true);
                yield " views</span>
                                            </div>
                                            <div class=\"discussion-preview\" style=\"color: rgba(255,255,255,0.7); font-size: 14px;\">
                                                ";
                // line 201
                yield (((Twig\Extension\CoreExtension::length($this->env->getCharset(), Twig\Extension\CoreExtension::striptags(CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "content", [], "any", false, false, false, 201))) > 100)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((Twig\Extension\CoreExtension::slice($this->env->getCharset(), Twig\Extension\CoreExtension::striptags(CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "content", [], "any", false, false, false, 201)), 0, 100) . "..."), "html", null, true)) : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::striptags(CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "content", [], "any", false, false, false, 201)), "html", null, true)));
                yield "
                                            </div>
                                            <div class=\"discussion-link mt-3\">
                                                <a href=\"";
                // line 204
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_discussion", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "id", [], "any", false, false, false, 204)]), "html", null, true);
                yield "\" class=\"template-btn btn-style-one\">
                                                    <span class=\"btn-wrap\">
                                                        <span class=\"text-one\">Read More</span>
                                                        <span class=\"text-two\">Read More</span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['discussion'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 214
            yield "                            </div>
                        </div>
                    ";
        }
        // line 217
        yield "                </div>

                <!-- Trending Sidebar -->
                <div class=\"col-lg-4\">
                    <div class=\"trending-panel\" style=\"background: rgba(255,255,255,0.08); border-radius: 15px; padding: 25px; border: 1px solid rgba(255,255,255,0.15); position: sticky; top: 20px;\">
                        <h3 class=\"text-white mb-4\" style=\"font-size: 20px; border-bottom: 2px solid #667eea; padding-bottom: 10px;\">
                            <i class=\"fa fa-fire\"></i> Trending Now
                        </h3>

                        <!-- Most Viewed Today -->
                        ";
        // line 227
        if ((($tmp = (isset($context["mostViewedToday"]) || array_key_exists("mostViewedToday", $context) ? $context["mostViewedToday"] : (function () { throw new RuntimeError('Variable "mostViewedToday" does not exist.', 227, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 228
            yield "                            <div class=\"trending-item mb-4\">
                                <h4 class=\"text-white mb-2\" style=\"font-size: 16px;\">
                                    🔥 Most Viewed Today
                                </h4>
                                <div class=\"trending-content\" style=\"background: rgba(255,255,255,0.05); padding: 15px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1);\">
                                    <h5 class=\"text-white mb-1\">
                                        <a href=\"";
            // line 234
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_discussion", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["mostViewedToday"]) || array_key_exists("mostViewedToday", $context) ? $context["mostViewedToday"] : (function () { throw new RuntimeError('Variable "mostViewedToday" does not exist.', 234, $this->source); })()), "id", [], "any", false, false, false, 234)]), "html", null, true);
            yield "\" style=\"color: white; text-decoration: none;\">
                                            ";
            // line 235
            yield (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["mostViewedToday"]) || array_key_exists("mostViewedToday", $context) ? $context["mostViewedToday"] : (function () { throw new RuntimeError('Variable "mostViewedToday" does not exist.', 235, $this->source); })()), "title", [], "any", false, false, false, 235)) > 40)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["mostViewedToday"]) || array_key_exists("mostViewedToday", $context) ? $context["mostViewedToday"] : (function () { throw new RuntimeError('Variable "mostViewedToday" does not exist.', 235, $this->source); })()), "title", [], "any", false, false, false, 235), 0, 40) . "..."), "html", null, true)) : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["mostViewedToday"]) || array_key_exists("mostViewedToday", $context) ? $context["mostViewedToday"] : (function () { throw new RuntimeError('Variable "mostViewedToday" does not exist.', 235, $this->source); })()), "title", [], "any", false, false, false, 235), "html", null, true)));
            yield "
                                        </a>
                                    </h5>
                                    <div class=\"trending-meta\" style=\"color: rgba(255,255,255,0.6); font-size: 12px;\">
                                        <i class=\"fa fa-eye\"></i> ";
            // line 239
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["mostViewedToday"]) || array_key_exists("mostViewedToday", $context) ? $context["mostViewedToday"] : (function () { throw new RuntimeError('Variable "mostViewedToday" does not exist.', 239, $this->source); })()), "views", [], "any", false, false, false, 239), "html", null, true);
            yield " views
                                    </div>
                                </div>
                            </div>
                        ";
        }
        // line 244
        yield "
                        <!-- Most Discussed Today -->
                        ";
        // line 246
        if ((($tmp = (isset($context["mostDiscussedToday"]) || array_key_exists("mostDiscussedToday", $context) ? $context["mostDiscussedToday"] : (function () { throw new RuntimeError('Variable "mostDiscussedToday" does not exist.', 246, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 247
            yield "                            <div class=\"trending-item mb-4\">
                                <h4 class=\"text-white mb-2\" style=\"font-size: 16px;\">
                                    💬 Most Discussed Today
                                </h4>
                                <div class=\"trending-content\" style=\"background: rgba(255,255,255,0.05); padding: 15px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1);\">
                                    <h5 class=\"text-white mb-1\">
                                        <a href=\"";
            // line 253
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_discussion", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["mostDiscussedToday"]) || array_key_exists("mostDiscussedToday", $context) ? $context["mostDiscussedToday"] : (function () { throw new RuntimeError('Variable "mostDiscussedToday" does not exist.', 253, $this->source); })()), "id", [], "any", false, false, false, 253)]), "html", null, true);
            yield "\" style=\"color: white; text-decoration: none;\">
                                            ";
            // line 254
            yield (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["mostDiscussedToday"]) || array_key_exists("mostDiscussedToday", $context) ? $context["mostDiscussedToday"] : (function () { throw new RuntimeError('Variable "mostDiscussedToday" does not exist.', 254, $this->source); })()), "title", [], "any", false, false, false, 254)) > 40)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["mostDiscussedToday"]) || array_key_exists("mostDiscussedToday", $context) ? $context["mostDiscussedToday"] : (function () { throw new RuntimeError('Variable "mostDiscussedToday" does not exist.', 254, $this->source); })()), "title", [], "any", false, false, false, 254), 0, 40) . "..."), "html", null, true)) : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["mostDiscussedToday"]) || array_key_exists("mostDiscussedToday", $context) ? $context["mostDiscussedToday"] : (function () { throw new RuntimeError('Variable "mostDiscussedToday" does not exist.', 254, $this->source); })()), "title", [], "any", false, false, false, 254), "html", null, true)));
            yield "
                                        </a>
                                    </h5>
                                    <div class=\"trending-meta\" style=\"color: rgba(255,255,255,0.6); font-size: 12px;\">
                                        <i class=\"fa fa-comments\"></i> ";
            // line 258
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["mostDiscussedToday"]) || array_key_exists("mostDiscussedToday", $context) ? $context["mostDiscussedToday"] : (function () { throw new RuntimeError('Variable "mostDiscussedToday" does not exist.', 258, $this->source); })()), "messages", [], "any", false, false, false, 258)), "html", null, true);
            yield " replies
                                    </div>
                                </div>
                            </div>
                        ";
        }
        // line 263
        yield "
                        <!-- Top 5 Most Viewed Overall -->
                        ";
        // line 265
        if ((($tmp = (isset($context["topViewedOverall"]) || array_key_exists("topViewedOverall", $context) ? $context["topViewedOverall"] : (function () { throw new RuntimeError('Variable "topViewedOverall" does not exist.', 265, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 266
            yield "                            <div class=\"trending-item\">
                                <h4 class=\"text-white mb-3\" style=\"font-size: 16px;\">
                                    📈 Top 5 Most Viewed
                                </h4>
                                <div class=\"top-viewed-list\">
                                    ";
            // line 271
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["topViewedOverall"]) || array_key_exists("topViewedOverall", $context) ? $context["topViewedOverall"] : (function () { throw new RuntimeError('Variable "topViewedOverall" does not exist.', 271, $this->source); })()));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["discussion"]) {
                // line 272
                yield "                                        <div class=\"top-viewed-item mb-2\" style=\"background: rgba(255,255,255,0.05); padding: 12px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.1);\">
                                            <div class=\"d-flex justify-content-between align-items-center\">
                                                <div class=\"flex-grow-1\">
                                                    <h6 class=\"text-white mb-1\" style=\"font-size: 14px; margin: 0;\">
                                                        ";
                // line 276
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 276), "html", null, true);
                yield ". 
                                                        <a href=\"";
                // line 277
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_discussion", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "id", [], "any", false, false, false, 277)]), "html", null, true);
                yield "\" style=\"color: white; text-decoration: none;\">
                                                            ";
                // line 278
                yield (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "title", [], "any", false, false, false, 278)) > 35)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "title", [], "any", false, false, false, 278), 0, 35) . "..."), "html", null, true)) : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "title", [], "any", false, false, false, 278), "html", null, true)));
                yield "
                                                        </a>
                                                    </h6>
                                                </div>
                                                <div class=\"views-count\" style=\"color: rgba(255,255,255,0.6); font-size: 12px; white-space: nowrap;\">
                                                    <i class=\"fa fa-eye\"></i> ";
                // line 283
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["discussion"], "views", [], "any", false, false, false, 283), "html", null, true);
                yield "
                                                </div>
                                            </div>
                                        </div>
                                    ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['discussion'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 288
            yield "                                </div>
                            </div>
                        ";
        }
        // line 291
        yield "                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.forum-category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
}

.discussion-card:hover {
    background: rgba(255,255,255,0.1) !important;
}

/* Notification Bell Styles */
.notification-dropdown {
    position: relative;
    margin: 0 15px;
}

.notification-bell {
    background: none;
    border: none;
    color: white;
    font-size: 18px;
    position: relative;
    cursor: pointer;
    padding: 8px 12px;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.notification-bell:hover {
    background: rgba(255,255,255,0.1);
    transform: scale(1.1);
}

.notification-badge {
    position: absolute;
    top: 0;
    right: 0;
    background: #ff4444;
    color: white;
    border-radius: 50%;
    width: 18px;
    height: 18px;
    font-size: 10px;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid rgba(255,255,255,0.3);
}

.notification-menu .dropdown-item {
    color: white;
    padding: 10px 15px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    text-decoration: none;
    display: block;
}

.notification-menu .dropdown-item:hover {
    background: rgba(255,255,255,0.1);
    color: white;
}

.notification-item {
    padding: 10px 15px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.notification-item:last-child {
    border-bottom: none;
}

.notification-item.unread {
    background: rgba(102, 126, 234, 0.2);
}

.notification-message {
    color: white;
    font-size: 14px;
    margin-bottom: 5px;
}

.notification-time {
    color: rgba(255,255,255,0.6);
    font-size: 12px;
}

.notification-actions {
    margin-top: 5px;
}

.notification-actions button {
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.3);
    color: white;
    padding: 2px 8px;
    font-size: 11px;
    border-radius: 3px;
    cursor: pointer;
    margin-right: 5px;
}

.notification-actions button:hover {
    background: rgba(255,255,255,0.2);
}

/* Forum Layout Improvements */
.forum-section {
    min-height: calc(100vh - 100px);
}

.sec-title.centered {
    margin-bottom: 4rem;
}

.sec-title_title {
    font-size: 16px;
    font-weight: 600;
    color: #667eea;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 15px;
}

.sec-title_heading {
    font-size: 48px;
    font-weight: 700;
    color: white;
    line-height: 1.2;
}

.sec-title_heading span {
    color: #667eea;
}

.search-box {
    max-width: 600px;
    margin: 0 auto 4rem auto;
}

.forum-category-card {
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 15px;
    padding: 30px;
    margin-bottom: 25px;
    transition: all 0.3s ease;
    height: 100%;
}

.discussion-card {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 20px;
    transition: all 0.3s ease;
}

</style>

<!-- Scripts -->
<script src=\"";
        // line 460
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/jquery.js"), "html", null, true);
        yield "\"></script>
<script>
\$(document).ready(function() {
    \$('.loader-wrap').fadeOut(500);
});

// Notification System
\$(document).ready(function() {
    // Load notifications on page load
    loadNotifications();
    
    // Refresh notifications every 30 seconds
    setInterval(loadNotifications, 30000);
    
    // Mark all as read
    \$('#markAllReadBtn').click(function(e) {
        e.preventDefault();
        \$.ajax({
            url: '/notifications/mark-all-read',
            method: 'POST',
            success: function(response) {
                if (response.success) {
                    loadNotifications();
                }
            }
        });
    });
});

function loadNotifications() {
    // Get unread count
    \$.ajax({
        url: '/notifications/unread-count',
        method: 'GET',
        success: function(response) {
            updateNotificationBadge(response.count);
        }
    });
    
    // Get recent notifications
    \$.ajax({
        url: '/notifications/recent',
        method: 'GET',
        success: function(response) {
            updateNotificationList(response.notifications);
        }
    });
}

function updateNotificationBadge(count) {
    var badge = \$('#notificationBadge');
    if (count > 0) {
        badge.text(count > 99 ? '99+' : count);
        badge.show();
    } else {
        badge.hide();
    }
}

function updateNotificationList(notifications) {
    var list = \$('#notificationList');
    
    if (notifications.length === 0) {
        list.html(`
            <div class=\"text-center text-white-50 p-3\">
                <i class=\"fa fa-bell-slash fa-2x mb-2\"></i>
                <p>No new notifications</p>
            </div>
        `);
        return;
    }
    
    var html = '';
    notifications.forEach(function(notification) {
        html += `
            <div class=\"notification-item unread\" data-id=\"\${notification.id}\">
                <div class=\"notification-message\">
                    <a href=\"\${notification.actionUrl}\" style=\"color: white; text-decoration: none;\">
                        \${notification.message}
                    </a>
                </div>
                <div class=\"notification-time\">\${notification.createdAt}</div>
                <div class=\"notification-actions\">
                    <button type=\"button\" onclick=\"markAsRead(\${notification.id})\">Mark as read</button>
                    <button type=\"button\" onclick=\"deleteNotification(\${notification.id})\">Delete</button>
                </div>
            </div>
        `;
    });
    
    list.html(html);
}

function markAsRead(notificationId) {
    \$.ajax({
        url: '/notifications/' + notificationId + '/mark-read',
        method: 'POST',
        success: function(response) {
            if (response.success) {
                loadNotifications();
            }
        }
    });
}

function deleteNotification(notificationId) {
    \$.ajax({
        url: '/notifications/' + notificationId + '/delete',
        method: 'POST',
        success: function(response) {
            if (response.success) {
                loadNotifications();
            }
        }
    });
}
</script>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "forum/index.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  731 => 460,  560 => 291,  555 => 288,  536 => 283,  528 => 278,  524 => 277,  520 => 276,  514 => 272,  497 => 271,  490 => 266,  488 => 265,  484 => 263,  476 => 258,  469 => 254,  465 => 253,  457 => 247,  455 => 246,  451 => 244,  443 => 239,  436 => 235,  432 => 234,  424 => 228,  422 => 227,  410 => 217,  405 => 214,  389 => 204,  383 => 201,  377 => 198,  373 => 197,  369 => 196,  362 => 192,  358 => 191,  353 => 188,  349 => 187,  344 => 184,  342 => 183,  337 => 180,  324 => 172,  322 => 171,  308 => 162,  302 => 159,  297 => 157,  293 => 156,  286 => 151,  281 => 150,  262 => 134,  237 => 111,  227 => 104,  217 => 98,  207 => 91,  198 => 85,  170 => 61,  168 => 60,  155 => 50,  151 => 49,  130 => 33,  101 => 6,  88 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Forum - {{ parent() }}{% endblock %}

{% block body %}
<div class=\"page-wrapper\">
    <!-- Preloader -->
    <div class=\"loader-wrap\">
        <div class=\"preloader\">
            <div class=\"preloader-close\">x</div>
            <div id=\"handle-preloader\" class=\"handle-preloader\">
                <div class=\"animation-preloader\">
                    <div class=\"txt-loading\">
                        <span data-text-preloader=\"F\" class=\"letters-loading\">F</span>
                        <span data-text-preloader=\"O\" class=\"letters-loading\">O</span>
                        <span data-text-preloader=\"R\" class=\"letters-loading\">R</span>
                        <span data-text-preloader=\"U\" class=\"letters-loading\">U</span>
                        <span data-text-preloader=\"M\" class=\"letters-loading\">M</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class=\"main-header header-style-one\">
        <div class=\"header-lower\">
            <div class=\"auto-container\">
                <div class=\"inner-container\">
                    <div class=\"d-flex justify-content-between align-items-center flex-wrap\">
                        
                        <div class=\"logo-box\">
                            <div class=\"logo\"><a href=\"{{ path('app_homepage') }}\"><img src=\"{{ asset('assets_front/images/logo.svg') }}\" alt=\"\" title=\"\"></a></div>
                        </div>
                        
                        <div class=\"nav-outer d-flex flex-wrap\">
                            <!-- Main Menu -->
                            <nav class=\"main-menu navbar-expand-md\">
                                <div class=\"navbar-header\">
                                    <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                                        <span class=\"icon-bar\"></span>
                                        <span class=\"icon-bar\"></span>
                                        <span class=\"icon-bar\"></span>
                                    </button>
                                </div>
                                
                                <div class=\"navbar-collapse collapse clearfix\" id=\"navbarSupportedContent\">
                                    <ul class=\"navigation clearfix\">
                                        <li><a href=\"{{ path('app_homepage') }}\">Home</a></li>
                                        <li class=\"current\"><a href=\"{{ path('forum_index') }}\">Forum</a></li>
                                        <li><a href=\"#\">About</a></li>
                                        <li><a href=\"#\">Contact</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>

                        <!-- Main Menu End-->
                        <div class=\"outer-box d-flex align-items-center flex-wrap\">
                            {% if app.user %}
                                <span class=\"welcome-text\">Welcome, {{ (app.user.firstName ~ ' ' ~ app.user.lastName)|trim|default(app.user.email) }}</span>
                                
                                <!-- Notification Bell -->
                                <div class=\"notification-dropdown\">
                                    <button type=\"button\" class=\"notification-bell\" id=\"notificationBell\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                                        <i class=\"fa fa-bell\"></i>
                                        <span class=\"notification-badge\" id=\"notificationBadge\" style=\"display: none;\">0</span>
                                    </button>
                                    <ul class=\"dropdown-menu dropdown-menu-end notification-menu\" id=\"notificationMenu\" style=\"background: rgba(0,0,0,0.9); border: 1px solid rgba(255,255,255,0.2); min-width: 300px; max-height: 400px; overflow-y: auto;\">
                                        <li class=\"dropdown-header text-white\">Notifications</li>
                                        <li><hr class=\"dropdown-divider\"></li>
                                        <li id=\"notificationList\">
                                            <div class=\"text-center text-white-50 p-3\">
                                                <i class=\"fa fa-bell-slash fa-2x mb-2\"></i>
                                                <p>No new notifications</p>
                                            </div>
                                        </li>
                                        <li><hr class=\"dropdown-divider\"></li>
                                        <li>
                                            <a href=\"#\" class=\"dropdown-item text-white\" id=\"markAllReadBtn\">Mark all as read</a>
                                        </li>
                                    </ul>
                                </div>
                                
                                <a href=\"{{ path('forum_new_discussion') }}\" class=\"template-btn btn-style-one\">
                                    <span class=\"btn-wrap\">
                                        <span class=\"text-one\">New Discussion</span>
                                        <span class=\"text-two\">New Discussion</span>
                                    </span>
                                </a>
                                <a href=\"{{ path('app_logout') }}\" class=\"template-btn btn-style-two\">
                                    <span class=\"btn-wrap\">
                                        <span class=\"text-one\">Logout</span>
                                        <span class=\"text-two\">Logout</span>
                                    </span>
                                </a>
                            {% else %}
                                <a href=\"{{ path('app_login') }}\" class=\"template-btn btn-style-two\">
                                    <span class=\"btn-wrap\">
                                        <span class=\"text-one\">Login</span>
                                        <span class=\"text-two\">Login</span>
                                    </span>
                                </a>
                                <a href=\"{{ path('app_register') }}\" class=\"template-btn btn-style-one\">
                                    <span class=\"btn-wrap\">
                                        <span class=\"text-one\">Join now</span>
                                        <span class=\"text-two\">Join now</span>
                                    </span>
                                </a>
                            {% endif %}
                        </div>

                        <!-- Mobile Navigation Toggler -->
                        <div class=\"mobile-nav-toggler\">
                            <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon icon-tabler icon-tabler-menu-2\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"1.5\" stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"/><path d=\"M4 6l16 0\" /><path d=\"M4 12l16 0\" /><path d=\"M4 18l16 0\" /></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Forum Content -->
    <section class=\"forum-section\" style=\"padding: 120px 0 80px 0;\">
        <div class=\"auto-container\">
            <!-- Page Title -->
            <div class=\"sec-title centered mb-5\">
                <div class=\"sec-title_title\">Community Forum</div>
                <h2 class=\"sec-title_heading\">Join the <span>Discussion</span></h2>
            </div>

            <!-- Search Bar -->
            <div class=\"search-box mb-5\">
                <form action=\"{{ path('forum_search') }}\" method=\"GET\" class=\"d-flex\">
                    <input type=\"text\" name=\"q\" class=\"form-control\" placeholder=\"Search discussions...\" style=\"background: white; color: #333; border: 1px solid #ddd;\">
                    <button type=\"submit\" class=\"template-btn btn-style-one ms-2\">
                        <span class=\"btn-wrap\">
                            <span class=\"text-one\">Search</span>
                            <span class=\"text-two\">Search</span>
                        </span>
                    </button>
                </form>
            </div>

            <div class=\"row\">
                <!-- Main Content -->
                <div class=\"col-lg-8\">
                    <!-- Categories Grid -->
                    <div class=\"row\">
                        {% for categoryData in categories %}
                            <div class=\"col-lg-4 col-md-6 mb-4\">
                                <div class=\"forum-category-card\" style=\"background: rgba(255,255,255,0.1); border-radius: 15px; padding: 25px; border: 1px solid rgba(255,255,255,0.2); backdrop-filter: blur(10px); transition: all 0.3s ease;\">
                                    <div class=\"category-icon mb-3\">
                                        <i class=\"fa fa-comments fa-3x\" style=\"color: #667eea;\"></i>
                                    </div>
                                    <h4 class=\"category-title\" style=\"color: white; margin-bottom: 10px;\">{{ categoryData.name }}</h4>
                                    <p class=\"category-description\" style=\"color: rgba(255,255,255,0.7); margin-bottom: 15px;\">{{ categoryData.description|default('No description available') }}</p>
                                    <div class=\"category-stats\" style=\"color: rgba(255,255,255,0.6); font-size: 14px;\">
                                        <i class=\"fa fa-comments\"></i> {{ categoryData.discussionCount }} discussions
                                    </div>
                                    <div class=\"category-link\">
                                        <a href=\"{{ path('forum_category', {'id': categoryData.id}) }}\" class=\"template-btn btn-style-two\">
                                            <span class=\"btn-wrap\">
                                                <span class=\"text-one\">View Category</span>
                                                <span class=\"text-two\">View Category</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        {% else %}
                            <div class=\"col-12\">
                                <div class=\"text-center\" style=\"color: white;\">
                                    <i class=\"fa fa-folder-open fa-4x mb-3\" style=\"color: rgba(255,255,255,0.5);\"></i>
                                    <h3>No categories yet</h3>
                                    <p>Be the first to start a discussion!</p>
                                </div>
                            </div>
                        {% endfor %}
                    </div>

                    <!-- Recent Discussions -->
                    {% if recentDiscussions %}
                        <div class=\"recent-discussions mt-5\">
                            <h3 class=\"text-white mb-4\">Recent Discussions</h3>
                            <div class=\"row\">
                                {% for discussion in recentDiscussions %}
                                    <div class=\"col-lg-6 mb-3\">
                                        <div class=\"discussion-card\" style=\"background: rgba(255,255,255,0.05); border-radius: 10px; padding: 20px; border: 1px solid rgba(255,255,255,0.1);\">
                                            <h5 class=\"discussion-title\" style=\"color: white; margin-bottom: 10px;\">
                                                <a href=\"{{ path('forum_discussion', {'id': discussion.id}) }}\" style=\"color: white; text-decoration: none;\">
                                                    {{ discussion.title|length > 50 ? discussion.title|slice(0, 50) ~ '...' : discussion.title }}
                                                </a>
                                            </h5>
                                            <div class=\"discussion-meta\" style=\"color: rgba(255,255,255,0.6); font-size: 12px; margin-bottom: 10px;\">
                                                <i class=\"fa fa-user\"></i> {{ discussion.authorName }}
                                                <span class=\"ms-2\"><i class=\"fa fa-clock\"></i> {{ discussion.createdAt|date('M d, Y H:i') }}</span>
                                                <span class=\"ms-2\"><i class=\"fa fa-eye\"></i> {{ discussion.views }} views</span>
                                            </div>
                                            <div class=\"discussion-preview\" style=\"color: rgba(255,255,255,0.7); font-size: 14px;\">
                                                {{ discussion.content|striptags|length > 100 ? discussion.content|striptags|slice(0, 100) ~ '...' : discussion.content|striptags }}
                                            </div>
                                            <div class=\"discussion-link mt-3\">
                                                <a href=\"{{ path('forum_discussion', {'id': discussion.id}) }}\" class=\"template-btn btn-style-one\">
                                                    <span class=\"btn-wrap\">
                                                        <span class=\"text-one\">Read More</span>
                                                        <span class=\"text-two\">Read More</span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                {% endfor %}
                            </div>
                        </div>
                    {% endif %}
                </div>

                <!-- Trending Sidebar -->
                <div class=\"col-lg-4\">
                    <div class=\"trending-panel\" style=\"background: rgba(255,255,255,0.08); border-radius: 15px; padding: 25px; border: 1px solid rgba(255,255,255,0.15); position: sticky; top: 20px;\">
                        <h3 class=\"text-white mb-4\" style=\"font-size: 20px; border-bottom: 2px solid #667eea; padding-bottom: 10px;\">
                            <i class=\"fa fa-fire\"></i> Trending Now
                        </h3>

                        <!-- Most Viewed Today -->
                        {% if mostViewedToday %}
                            <div class=\"trending-item mb-4\">
                                <h4 class=\"text-white mb-2\" style=\"font-size: 16px;\">
                                    🔥 Most Viewed Today
                                </h4>
                                <div class=\"trending-content\" style=\"background: rgba(255,255,255,0.05); padding: 15px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1);\">
                                    <h5 class=\"text-white mb-1\">
                                        <a href=\"{{ path('forum_discussion', {'id': mostViewedToday.id}) }}\" style=\"color: white; text-decoration: none;\">
                                            {{ mostViewedToday.title|length > 40 ? mostViewedToday.title|slice(0, 40) ~ '...' : mostViewedToday.title }}
                                        </a>
                                    </h5>
                                    <div class=\"trending-meta\" style=\"color: rgba(255,255,255,0.6); font-size: 12px;\">
                                        <i class=\"fa fa-eye\"></i> {{ mostViewedToday.views }} views
                                    </div>
                                </div>
                            </div>
                        {% endif %}

                        <!-- Most Discussed Today -->
                        {% if mostDiscussedToday %}
                            <div class=\"trending-item mb-4\">
                                <h4 class=\"text-white mb-2\" style=\"font-size: 16px;\">
                                    💬 Most Discussed Today
                                </h4>
                                <div class=\"trending-content\" style=\"background: rgba(255,255,255,0.05); padding: 15px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1);\">
                                    <h5 class=\"text-white mb-1\">
                                        <a href=\"{{ path('forum_discussion', {'id': mostDiscussedToday.id}) }}\" style=\"color: white; text-decoration: none;\">
                                            {{ mostDiscussedToday.title|length > 40 ? mostDiscussedToday.title|slice(0, 40) ~ '...' : mostDiscussedToday.title }}
                                        </a>
                                    </h5>
                                    <div class=\"trending-meta\" style=\"color: rgba(255,255,255,0.6); font-size: 12px;\">
                                        <i class=\"fa fa-comments\"></i> {{ mostDiscussedToday.messages|length }} replies
                                    </div>
                                </div>
                            </div>
                        {% endif %}

                        <!-- Top 5 Most Viewed Overall -->
                        {% if topViewedOverall %}
                            <div class=\"trending-item\">
                                <h4 class=\"text-white mb-3\" style=\"font-size: 16px;\">
                                    📈 Top 5 Most Viewed
                                </h4>
                                <div class=\"top-viewed-list\">
                                    {% for discussion in topViewedOverall %}
                                        <div class=\"top-viewed-item mb-2\" style=\"background: rgba(255,255,255,0.05); padding: 12px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.1);\">
                                            <div class=\"d-flex justify-content-between align-items-center\">
                                                <div class=\"flex-grow-1\">
                                                    <h6 class=\"text-white mb-1\" style=\"font-size: 14px; margin: 0;\">
                                                        {{ loop.index }}. 
                                                        <a href=\"{{ path('forum_discussion', {'id': discussion.id}) }}\" style=\"color: white; text-decoration: none;\">
                                                            {{ discussion.title|length > 35 ? discussion.title|slice(0, 35) ~ '...' : discussion.title }}
                                                        </a>
                                                    </h6>
                                                </div>
                                                <div class=\"views-count\" style=\"color: rgba(255,255,255,0.6); font-size: 12px; white-space: nowrap;\">
                                                    <i class=\"fa fa-eye\"></i> {{ discussion.views }}
                                                </div>
                                            </div>
                                        </div>
                                    {% endfor %}
                                </div>
                            </div>
                        {% endif %}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.forum-category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
}

.discussion-card:hover {
    background: rgba(255,255,255,0.1) !important;
}

/* Notification Bell Styles */
.notification-dropdown {
    position: relative;
    margin: 0 15px;
}

.notification-bell {
    background: none;
    border: none;
    color: white;
    font-size: 18px;
    position: relative;
    cursor: pointer;
    padding: 8px 12px;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.notification-bell:hover {
    background: rgba(255,255,255,0.1);
    transform: scale(1.1);
}

.notification-badge {
    position: absolute;
    top: 0;
    right: 0;
    background: #ff4444;
    color: white;
    border-radius: 50%;
    width: 18px;
    height: 18px;
    font-size: 10px;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid rgba(255,255,255,0.3);
}

.notification-menu .dropdown-item {
    color: white;
    padding: 10px 15px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    text-decoration: none;
    display: block;
}

.notification-menu .dropdown-item:hover {
    background: rgba(255,255,255,0.1);
    color: white;
}

.notification-item {
    padding: 10px 15px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.notification-item:last-child {
    border-bottom: none;
}

.notification-item.unread {
    background: rgba(102, 126, 234, 0.2);
}

.notification-message {
    color: white;
    font-size: 14px;
    margin-bottom: 5px;
}

.notification-time {
    color: rgba(255,255,255,0.6);
    font-size: 12px;
}

.notification-actions {
    margin-top: 5px;
}

.notification-actions button {
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.3);
    color: white;
    padding: 2px 8px;
    font-size: 11px;
    border-radius: 3px;
    cursor: pointer;
    margin-right: 5px;
}

.notification-actions button:hover {
    background: rgba(255,255,255,0.2);
}

/* Forum Layout Improvements */
.forum-section {
    min-height: calc(100vh - 100px);
}

.sec-title.centered {
    margin-bottom: 4rem;
}

.sec-title_title {
    font-size: 16px;
    font-weight: 600;
    color: #667eea;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 15px;
}

.sec-title_heading {
    font-size: 48px;
    font-weight: 700;
    color: white;
    line-height: 1.2;
}

.sec-title_heading span {
    color: #667eea;
}

.search-box {
    max-width: 600px;
    margin: 0 auto 4rem auto;
}

.forum-category-card {
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 15px;
    padding: 30px;
    margin-bottom: 25px;
    transition: all 0.3s ease;
    height: 100%;
}

.discussion-card {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 20px;
    transition: all 0.3s ease;
}

</style>

<!-- Scripts -->
<script src=\"{{ asset('assets_front/js/jquery.js') }}\"></script>
<script>
\$(document).ready(function() {
    \$('.loader-wrap').fadeOut(500);
});

// Notification System
\$(document).ready(function() {
    // Load notifications on page load
    loadNotifications();
    
    // Refresh notifications every 30 seconds
    setInterval(loadNotifications, 30000);
    
    // Mark all as read
    \$('#markAllReadBtn').click(function(e) {
        e.preventDefault();
        \$.ajax({
            url: '/notifications/mark-all-read',
            method: 'POST',
            success: function(response) {
                if (response.success) {
                    loadNotifications();
                }
            }
        });
    });
});

function loadNotifications() {
    // Get unread count
    \$.ajax({
        url: '/notifications/unread-count',
        method: 'GET',
        success: function(response) {
            updateNotificationBadge(response.count);
        }
    });
    
    // Get recent notifications
    \$.ajax({
        url: '/notifications/recent',
        method: 'GET',
        success: function(response) {
            updateNotificationList(response.notifications);
        }
    });
}

function updateNotificationBadge(count) {
    var badge = \$('#notificationBadge');
    if (count > 0) {
        badge.text(count > 99 ? '99+' : count);
        badge.show();
    } else {
        badge.hide();
    }
}

function updateNotificationList(notifications) {
    var list = \$('#notificationList');
    
    if (notifications.length === 0) {
        list.html(`
            <div class=\"text-center text-white-50 p-3\">
                <i class=\"fa fa-bell-slash fa-2x mb-2\"></i>
                <p>No new notifications</p>
            </div>
        `);
        return;
    }
    
    var html = '';
    notifications.forEach(function(notification) {
        html += `
            <div class=\"notification-item unread\" data-id=\"\${notification.id}\">
                <div class=\"notification-message\">
                    <a href=\"\${notification.actionUrl}\" style=\"color: white; text-decoration: none;\">
                        \${notification.message}
                    </a>
                </div>
                <div class=\"notification-time\">\${notification.createdAt}</div>
                <div class=\"notification-actions\">
                    <button type=\"button\" onclick=\"markAsRead(\${notification.id})\">Mark as read</button>
                    <button type=\"button\" onclick=\"deleteNotification(\${notification.id})\">Delete</button>
                </div>
            </div>
        `;
    });
    
    list.html(html);
}

function markAsRead(notificationId) {
    \$.ajax({
        url: '/notifications/' + notificationId + '/mark-read',
        method: 'POST',
        success: function(response) {
            if (response.success) {
                loadNotifications();
            }
        }
    });
}

function deleteNotification(notificationId) {
    \$.ajax({
        url: '/notifications/' + notificationId + '/delete',
        method: 'POST',
        success: function(response) {
            if (response.success) {
                loadNotifications();
            }
        }
    });
}
</script>
{% endblock %}
", "forum/index.html.twig", "C:\\Users\\LordKiller\\Downloads\\user\\templates\\forum\\index.html.twig");
    }
}
