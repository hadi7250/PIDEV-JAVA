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

/* forum/show.html.twig */
class __TwigTemplate_54644490aabf7677c493418f046777f6 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "forum/show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "forum/show.html.twig"));

        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 87
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

        // line 88
        yield "<div class=\"page-wrapper\">
    <!-- Preloader -->
    <div class=\"loader-wrap\">
        <div class=\"preloader\">
            <div class=\"preloader-close\">x</div>
            <div id=\"handle-preloader\" class=\"handle-preloader\">
                <div class=\"animation-preloader\">
                    <div class=\"txt-loading\">
                        <span data-text-preloader=\"L\" class=\"letters-loading\">L</span>
                        <span data-text-preloader=\"O\" class=\"letters-loading\">O</span>
                        <span data-text-preloader=\"A\" class=\"letters-loading\">A</span>
                        <span data-text-preloader=\"D\" class=\"letters-loading\">D</span>
                        <span data-text-preloader=\"I\" class=\"letters-loading\">I</span>
                        <span data-text-preloader=\"N\" class=\"letters-loading\">N</span>
                        <span data-text-preloader=\"G\" class=\"letters-loading\">G</span>
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
                    <div class=\"d-flex justify-content-between align-items-center flex-wrap\" style=\"display: flex; align-items: center; justify-content: space-between;\">
                        
                        <div class=\"logo-box\">
                            <div class=\"logo\"><a href=\"";
        // line 117
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_homepage");
        yield "\"><img src=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/images/logo.svg"), "html", null, true);
        yield "\" alt=\"\" title=\"\"></a></div>
                        </div>
                        
                        <div class=\"nav-outer d-flex flex-wrap align-items-center\">
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
        // line 133
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_homepage");
        yield "\">Home</a></li>
                                        <li><a href=\"";
        // line 134
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_index");
        yield "\">Forum</a></li>
                                        <li><a href=\"";
        // line 135
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_category", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["discussion"]) || array_key_exists("discussion", $context) ? $context["discussion"] : (function () { throw new RuntimeError('Variable "discussion" does not exist.', 135, $this->source); })()), "category", [], "any", false, false, false, 135), "id", [], "any", false, false, false, 135)]), "html", null, true);
        yield "\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["discussion"]) || array_key_exists("discussion", $context) ? $context["discussion"] : (function () { throw new RuntimeError('Variable "discussion" does not exist.', 135, $this->source); })()), "category", [], "any", false, false, false, 135), "name", [], "any", false, false, false, 135), "html", null, true);
        yield "</a></li>
                                        <li class=\"current\"><a href=\"#\">";
        // line 136
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["discussion"]) || array_key_exists("discussion", $context) ? $context["discussion"] : (function () { throw new RuntimeError('Variable "discussion" does not exist.', 136, $this->source); })()), "title", [], "any", false, false, false, 136), 0, 30), "html", null, true);
        yield "...</a></li>
                                    </ul>
                                </div>
                            </nav>

                            <!-- Main Menu End-->
                            <div class=\"outer-box d-flex align-items-center flex-wrap\">
                                ";
        // line 143
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 143, $this->source); })()), "user", [], "any", false, false, false, 143)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 144
            yield "                                    <span class=\"welcome-text\">Welcome, ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::default(Twig\Extension\CoreExtension::trim(((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 144, $this->source); })()), "user", [], "any", false, false, false, 144), "firstName", [], "any", false, false, false, 144) . " ") . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 144, $this->source); })()), "user", [], "any", false, false, false, 144), "lastName", [], "any", false, false, false, 144))), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 144, $this->source); })()), "user", [], "any", false, false, false, 144), "email", [], "any", false, false, false, 144)), "html", null, true);
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
            // line 168
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_new_discussion");
            yield "\" class=\"template-btn btn-style-one\">
                                        <span class=\"btn-wrap\">
                                            <span class=\"text-one\">New Discussion</span>
                                            <span class=\"text-two\">New Discussion</span>
                                        </span>
                                    </a>
                                    <a href=\"";
            // line 174
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
            yield "\" class=\"template-btn btn-style-two\">
                                        <span class=\"btn-wrap\">
                                            <span class=\"text-one\">Logout</span>
                                            <span class=\"text-two\">Logout</span>
                                        </span>
                                    </a>
                            ";
        } else {
            // line 181
            yield "                                <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
            yield "\" class=\"template-btn btn-style-two\">
                                    <span class=\"btn-wrap\">
                                        <span class=\"text-one\">Login</span>
                                        <span class=\"text-two\">Login</span>
                                    </span>
                                </a>
                                <a href=\"";
            // line 187
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
            yield "\" class=\"template-btn btn-style-one\">
                                    <span class=\"btn-wrap\">
                                        <span class=\"text-one\">Join now</span>
                                        <span class=\"text-two\">Join now</span>
                                    </span>
                                </a>
                            ";
        }
        // line 194
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

    <!-- Discussion Content -->
    <section class=\"discussion-content\" style=\"padding: 120px 0 80px 0;\">
        <div class=\"auto-container\">
            <!-- Original Post -->
            <div class=\"original-post\" style=\"background: rgba(255,255,255,0.08); border-radius: 15px; padding: 40px; margin-bottom: 40px; border: 1px solid rgba(255,255,255,0.15);\">
                <div class=\"post-header mb-4\">
                    <div class=\"d-flex justify-content-between align-items-start\">
                        <div>
                            <h1 class=\"post-title text-white mb-4\">";
        // line 214
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["discussion"]) || array_key_exists("discussion", $context) ? $context["discussion"] : (function () { throw new RuntimeError('Variable "discussion" does not exist.', 214, $this->source); })()), "title", [], "any", false, false, false, 214), "html", null, true);
        yield "</h1>
                            <div class=\"post-meta\" style=\"color: rgba(255,255,255,0.7);\">
                                <span><i class=\"fa fa-user\"></i> ";
        // line 216
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["discussion"]) || array_key_exists("discussion", $context) ? $context["discussion"] : (function () { throw new RuntimeError('Variable "discussion" does not exist.', 216, $this->source); })()), "authorName", [], "any", false, false, false, 216), "html", null, true);
        yield "</span>
                                <span class=\"ms-3\"><i class=\"fa fa-clock\"></i> ";
        // line 217
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["discussion"]) || array_key_exists("discussion", $context) ? $context["discussion"] : (function () { throw new RuntimeError('Variable "discussion" does not exist.', 217, $this->source); })()), "createdAt", [], "any", false, false, false, 217), "M d, Y H:i"), "html", null, true);
        yield "</span>
                                ";
        // line 218
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["discussion"]) || array_key_exists("discussion", $context) ? $context["discussion"] : (function () { throw new RuntimeError('Variable "discussion" does not exist.', 218, $this->source); })()), "updatedAt", [], "any", false, false, false, 218) != CoreExtension::getAttribute($this->env, $this->source, (isset($context["discussion"]) || array_key_exists("discussion", $context) ? $context["discussion"] : (function () { throw new RuntimeError('Variable "discussion" does not exist.', 218, $this->source); })()), "createdAt", [], "any", false, false, false, 218))) {
            // line 219
            yield "                                    <span class=\"ms-3\"><i class=\"fa fa-edit\"></i> Updated ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["discussion"]) || array_key_exists("discussion", $context) ? $context["discussion"] : (function () { throw new RuntimeError('Variable "discussion" does not exist.', 219, $this->source); })()), "updatedAt", [], "any", false, false, false, 219), "M d, Y H:i"), "html", null, true);
            yield "</span>
                                ";
        }
        // line 221
        yield "                            </div>
                        </div>
                        ";
        // line 223
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 223, $this->source); })()), "user", [], "any", false, false, false, 223)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 224
            yield "                            ";
            $context["userAuthorName"] = Twig\Extension\CoreExtension::trim(((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 224, $this->source); })()), "user", [], "any", false, false, false, 224), "firstName", [], "any", false, false, false, 224) . " ") . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 224, $this->source); })()), "user", [], "any", false, false, false, 224), "lastName", [], "any", false, false, false, 224)));
            // line 225
            yield "                            ";
            if ((((isset($context["userAuthorName"]) || array_key_exists("userAuthorName", $context) ? $context["userAuthorName"] : (function () { throw new RuntimeError('Variable "userAuthorName" does not exist.', 225, $this->source); })()) == CoreExtension::getAttribute($this->env, $this->source, (isset($context["discussion"]) || array_key_exists("discussion", $context) ? $context["discussion"] : (function () { throw new RuntimeError('Variable "discussion" does not exist.', 225, $this->source); })()), "authorName", [], "any", false, false, false, 225)) || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN"))) {
                // line 226
                yield "                            <div class=\"post-actions d-flex gap-2\">
                                ";
                // line 227
                if (((isset($context["userAuthorName"]) || array_key_exists("userAuthorName", $context) ? $context["userAuthorName"] : (function () { throw new RuntimeError('Variable "userAuthorName" does not exist.', 227, $this->source); })()) == CoreExtension::getAttribute($this->env, $this->source, (isset($context["discussion"]) || array_key_exists("discussion", $context) ? $context["discussion"] : (function () { throw new RuntimeError('Variable "discussion" does not exist.', 227, $this->source); })()), "authorName", [], "any", false, false, false, 227))) {
                    // line 228
                    yield "                                    <a href=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_edit_discussion", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["discussion"]) || array_key_exists("discussion", $context) ? $context["discussion"] : (function () { throw new RuntimeError('Variable "discussion" does not exist.', 228, $this->source); })()), "id", [], "any", false, false, false, 228)]), "html", null, true);
                    yield "\" class=\"btn btn-sm\" style=\"background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3); padding: 8px 15px; border-radius: 5px;\">
                                        <i class=\"fa fa-edit\"></i> Edit Discussion
                                    </a>
                                ";
                }
                // line 232
                yield "                                <form method=\"POST\" action=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_delete_discussion", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["discussion"]) || array_key_exists("discussion", $context) ? $context["discussion"] : (function () { throw new RuntimeError('Variable "discussion" does not exist.', 232, $this->source); })()), "id", [], "any", false, false, false, 232)]), "html", null, true);
                yield "\">
                                    <input type=\"hidden\" name=\"_token\" value=\"";
                // line 233
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete_discussion_" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["discussion"]) || array_key_exists("discussion", $context) ? $context["discussion"] : (function () { throw new RuntimeError('Variable "discussion" does not exist.', 233, $this->source); })()), "id", [], "any", false, false, false, 233))), "html", null, true);
                yield "\">
                                    <button type=\"submit\" class=\"btn btn-sm\" style=\"background: rgba(220,53,69,0.8); color: white; border: 1px solid rgba(220,53,69,0.5); padding: 8px 15px; border-radius: 5px;\">
                                        <i class=\"fa fa-trash\"></i> Delete Discussion
                                    </button>
                                </form>
                            </div>
                            ";
            }
            // line 240
            yield "                        ";
        }
        // line 241
        yield "                    </div>
                </div>
                <div class=\"post-content text-white-80\" style=\"line-height: 1.6;\">
                    ";
        // line 244
        yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["discussion"]) || array_key_exists("discussion", $context) ? $context["discussion"] : (function () { throw new RuntimeError('Variable "discussion" does not exist.', 244, $this->source); })()), "content", [], "any", false, false, false, 244), "html", null, true));
        yield "
                </div>

                            </div>

            <!-- Flash Messages -->
            ";
        // line 250
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 250, $this->source); })()), "flashes", [], "any", false, false, false, 250));
        foreach ($context['_seq'] as $context["type"] => $context["messages"]) {
            // line 251
            yield "                ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 252
                yield "                    <div class=\"alert alert-";
                yield ((($context["type"] == "error")) ? ("danger") : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["type"], "html", null, true)));
                yield " alert-dismissible fade show mt-3\" style=\"background: ";
                yield ((($context["type"] == "error")) ? ("rgba(220,53,69,0.2)") : ("rgba(40,167,69,0.2)"));
                yield "; border: 1px solid ";
                yield ((($context["type"] == "error")) ? ("rgba(220,53,69,0.5)") : ("rgba(40,167,69,0.5)"));
                yield "; color: white; border-radius: 8px; padding: 15px;\">
                        ";
                // line 253
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
                yield "
                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" style=\"filter: invert(1);\"></button>
                    </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 257
            yield "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['type'], $context['messages'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 258
        yield "
            <!-- Messages Section -->
            <div class=\"messages-section\">
                <h3 class=\"text-white mb-5\">Replies</h3>

                ";
        // line 263
        if ((($tmp = (isset($context["rootMessages"]) || array_key_exists("rootMessages", $context) ? $context["rootMessages"] : (function () { throw new RuntimeError('Variable "rootMessages" does not exist.', 263, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 264
            yield "                    ";
            $macros["self"] = $this;
            // line 265
            yield "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["rootMessages"]) || array_key_exists("rootMessages", $context) ? $context["rootMessages"] : (function () { throw new RuntimeError('Variable "rootMessages" does not exist.', 265, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 266
                yield "                        ";
                yield $macros["self"]->getTemplateForMacro("macro_renderMessage", $context, 266, $this->getSourceContext())->macro_renderMessage(...[$context["message"], 0, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 266, $this->source); })())]);
                yield "
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 268
            yield "                ";
        } else {
            // line 269
            yield "                    <div class=\"no-messages text-center py-5\">
                        <i class=\"fa fa-comment-slash fa-3x mb-3\" style=\"color: rgba(255,255,255,0.3);\"></i>
                        <p class=\"text-white-50\">No replies yet. Be the first to reply!</p>
                    </div>
                ";
        }
        // line 274
        yield "            </div>

            <!-- Reply Form -->
            ";
        // line 277
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 277, $this->source); })()), "user", [], "any", false, false, false, 277) && (isset($context["messageForm"]) || array_key_exists("messageForm", $context) ? $context["messageForm"] : (function () { throw new RuntimeError('Variable "messageForm" does not exist.', 277, $this->source); })()))) {
            // line 278
            yield "                <div class=\"reply-form mt-5 pt-5\">
                    <h4 class=\"text-white mb-4\">Add Your Reply</h4>
                    ";
            // line 280
            yield             $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["messageForm"]) || array_key_exists("messageForm", $context) ? $context["messageForm"] : (function () { throw new RuntimeError('Variable "messageForm" does not exist.', 280, $this->source); })()), 'form_start', ["attr" => ["class" => "reply-form-ajax", "data-discussion-id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["discussion"]) || array_key_exists("discussion", $context) ? $context["discussion"] : (function () { throw new RuntimeError('Variable "discussion" does not exist.', 280, $this->source); })()), "id", [], "any", false, false, false, 280)]]);
            yield "
                        <div class=\"mb-3\">
                            ";
            // line 282
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["messageForm"]) || array_key_exists("messageForm", $context) ? $context["messageForm"] : (function () { throw new RuntimeError('Variable "messageForm" does not exist.', 282, $this->source); })()), "content", [], "any", false, false, false, 282), 'widget', ["attr" => ["class" => "form-control", "rows" => 4, "placeholder" => "Write your reply here...", "style" => "background: white; color: #333; border: 1px solid #ddd;"]]);
            yield "
                            ";
            // line 283
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["messageForm"]) || array_key_exists("messageForm", $context) ? $context["messageForm"] : (function () { throw new RuntimeError('Variable "messageForm" does not exist.', 283, $this->source); })()), "content", [], "any", false, false, false, 283), 'errors');
            yield "
                        </div>
                        <button type=\"submit\" class=\"template-btn btn-style-one\">
                            <span class=\"btn-wrap\">
                                <span class=\"text-one\">Post Reply</span>
                                <span class=\"text-two\">Post Reply</span>
                            </span>
                        </button>
                    ";
            // line 291
            yield             $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["messageForm"]) || array_key_exists("messageForm", $context) ? $context["messageForm"] : (function () { throw new RuntimeError('Variable "messageForm" does not exist.', 291, $this->source); })()), 'form_end');
            yield "
                </div>
            ";
        } elseif ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source,         // line 293
(isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 293, $this->source); })()), "user", [], "any", false, false, false, 293)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 294
            yield "                <div class=\"login-prompt text-center mt-5\" style=\"background: rgba(255,255,255,0.05); border-radius: 10px; padding: 30px; border: 1px solid rgba(255,255,255,0.1);\">
                    <i class=\"fa fa-lock fa-3x mb-3\" style=\"color: rgba(255,255,255,0.3);\"></i>
                    <h4 class=\"text-white mb-3\">Login to Reply</h4>
                    <p class=\"text-white-50 mb-4\">You need to be logged in to participate in discussions.</p>
                    <a href=\"";
            // line 298
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
            yield "\" class=\"template-btn btn-style-one\">
                        <span class=\"btn-wrap\">
                            <span class=\"text-one\">Login Now</span>
                            <span class=\"text-two\">Login Now</span>
                        </span>
                    </a>
                </div>
            ";
        }
        // line 306
        yield "        </div>
    </section>
</div>

<style>
.message-item:hover {
    background: rgba(255,255,255,0.08) !important;
}

.vote-btn:hover {
    opacity: 0.7;
}

.vote-btn.voted {
    font-weight: bold;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: \">\";
    color: rgba(255,255,255,0.6);
}

.text-white-80 {
    color: rgba(255,255,255,0.8) !important;
}

.text-white-80 {
    color: rgba(255,255,255,0.8) !important;
}

.text-white-50 {
    color: rgba(255,255,255,0.5) !important;
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

/* Discussion Layout Improvements */
.discussion-content {
    min-height: calc(100vh - 400px);
}

.original-post {
    position: relative;
    background: linear-gradient(135deg, rgba(255,255,255,0.08) 0%, rgba(255,255,255,0.05) 100%) !important;
    border: 1px solid rgba(255,255,255,0.15) !important;
    box-shadow: 0 8px 32px rgba(0,0,0,0.1);
}

.original-post::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    border-radius: 15px 15px 0 0;
}

.post-title {
    font-size: 32px;
    font-weight: 700;
    line-height: 1.3;
    margin-bottom: 20px !important;
}

.post-meta {
    font-size: 14px;
    opacity: 0.8;
}

.post-meta span {
    margin-right: 15px;
}

.messages-section {
    margin-top: 50px;
}

.messages-section h3 {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 30px !important;
    padding-bottom: 15px;
    border-bottom: 2px solid rgba(255,255,255,0.1);
}

.message-item {
    position: relative;
    background: rgba(255,255,255,0.08) !important;
    border: 1px solid rgba(255,255,255,0.1) !important;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.message-item:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 25px rgba(102, 126, 234, 0.1);
}

.message-header {
    border-bottom: 1px solid rgba(255,255,255,0.05);
    padding-bottom: 15px;
}

.author-info strong {
    font-size: 16px;
    font-weight: 600;
}

.message-time {
    font-size: 12px;
    opacity: 0.7;
    margin-top: 5px;
}

.message-content {
    font-size: 15px !important;
    line-height: 1.7 !important;
    word-wrap: break-word;
}

.reply-form {
    border-top: 2px solid rgba(255,255,255,0.1);
    padding-top: 40px !important;
    margin-top: 40px !important;
}

.reply-form h4 {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 25px !important;
}

.form-control {
    border-radius: 8px !important;
    border: 1px solid #ddd !important;
    padding: 12px 15px !important;
    font-size: 15px !important;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #667eea !important;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1) !important;
}

.reply-toggle {
    transition: all 0.3s ease;
}

.reply-toggle:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
}

.reply-form-container {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px;
    padding: 20px;
    margin-top: 20px !important;
}

.no-messages {
    background: rgba(255,255,255,0.03);
    border: 2px dashed rgba(255,255,255,0.1);
    border-radius: 15px;
    padding: 60px 30px !important;
    text-align: center;
}

.no-messages i {
    opacity: 0.5;
    margin-bottom: 20px !important;
}

.no-messages p {
    font-size: 16px;
    opacity: 0.7;
}

/* Header Alignment Fix */
.header-lower .inner-container > div {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
}

.logo-box {
    margin: 0 !important;
    padding: 0 !important;
}

.nav-outer {
    display: flex !important;
    align-items: center !important;
    margin: 0 !important;
}

.main-menu {
    margin: 0 !important;
}

.main-menu ul {
    margin: 0 !important;
    padding: 0 !important;
}

.outer-box {
    margin: 0 !important;
    padding: 0 !important;
}

.welcome-text {
    margin: 0 15px 0 0 !important;
    align-self: center !important;
}

.notification-dropdown {
    margin: 0 10px 0 0 !important;
    align-self: center !important;
}

.template-btn {
    margin: 0 0 0 10px !important;
    align-self: center !important;
}

</style>

<!-- Scripts -->
<script src=\"";
        // line 632
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/js/jquery.js"), "html", null, true);
        yield "\"></script>
<script>
\$(document).ready(function() {
    \$('.loader-wrap').fadeOut(500);

    // Handle reply form submission
    \$('.reply-form-ajax').submit(function(e) {
        e.preventDefault();
        
        var form = \$(this);
        var discussionId = form.data('discussion-id');
        var content = form.find('textarea[name=\"forum_message[content]\"]').val();
        
        \$.ajax({
            url: '/api/messages',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                discussionId: discussionId,
                content: content
            }),
            success: function(response) {
                if (response.success) {
                    // Add new message to the list
                    var newMessage = `
                        <div class=\"message-item\" style=\"background: rgba(255,255,255,0.05); border-radius: 10px; padding: 20px; margin-bottom: 15px; border: 1px solid rgba(255,255,255,0.1);\">
                            <div class=\"message-header d-flex justify-content-between align-items-start mb-3\">
                                <div class=\"author-info\">
                                    <strong class=\"text-white\">\${response.message.authorName}</strong>
                                    <div class=\"message-time\" style=\"color: rgba(255,255,255,0.6); font-size: 12px;\">
                                        \${response.message.createdAt}
                                    </div>
                                </div>
                                <div class=\"vote-buttons\">
                                    <form method=\"POST\" action=\"/forum/vote/up/\${response.message.id}\" style=\"display: inline;\">
                                        <button type=\"submit\" class=\"vote-btn upvote-btn\" style=\"background: none; border: none; color: #28a745; cursor: pointer; margin-right: 10px;\">
                                            <i class=\"fa fa-thumbs-up\"></i> <span class=\"upvote-count\">\${response.message.upvotes}</span>
                                        </button>
                                    </form>
                                    <form method=\"POST\" action=\"/forum/vote/down/\${response.message.id}\" style=\"display: inline;\">
                                        <button type=\"submit\" class=\"vote-btn downvote-btn\" style=\"background: none; border: none; color: #dc3545; cursor: pointer;\">
                                            <i class=\"fa fa-thumbs-down\"></i> <span class=\"downvote-count\">\${response.message.downvotes}</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class=\"message-content text-white-80\" style=\"line-height: 1.5;\">
                                \${response.message.content.replace(/\\n/g, '<br>')}
                            </div>
                        </div>
                    `;
                    
                    \$('.messages-section .no-messages').remove();
                    \$('.messages-section').append(newMessage);
                    
                    // Clear form
                    form.find('textarea').val('');
                    
                    // Update reply count
                    var replyCount = parseInt(\$('.messages-section h3').text().match(/\\d+/)[0]) + 1;
                    \$('.messages-section h3').text('Replies (' + replyCount + ')');
                }
            },
            error: function(xhr, status, errorThrown) {
                console.error('AJAX Error Status:', status);
                console.error('HTTP Status Code:', xhr.status);
                console.error('Error Thrown:', errorThrown);
                console.error('Response Text:', xhr.responseText);
                console.error('Response JSON:', xhr.responseJSON);
                
                var errorMsg = 'Server Error: ';
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    errorMsg += xhr.responseJSON.error;
                } else if (xhr.responseText) {
                    errorMsg += xhr.responseText.substring(0, 200);
                } else {
                    errorMsg += errorThrown || 'Unknown error';
                }
                alert(errorMsg);
            }
        });
    });
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

// Reply form toggle
\$(document).on('click', '.reply-toggle', function() {
    var messageId = \$(this).data('message-id');
    \$('#reply-form-' + messageId).slideToggle();
});

// Reply form cancel
\$(document).on('click', '.reply-cancel', function() {
    var messageId = \$(this).data('message-id');
    \$('#reply-form-' + messageId).slideUp();
});
</script>

";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 3
    public function macro_renderMessage($message = null, $level = null, $app = null, ...$varargs): string|Markup
    {
        $macros = $this->macros;
        $context = [
            "message" => $message,
            "level" => $level,
            "app" => $app,
            "varargs" => $varargs,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
            $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "macro", "renderMessage"));

            $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
            $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "macro", "renderMessage"));

            // line 4
            yield "    ";
            $macros["self"] = $this;
            // line 5
            yield "    ";
            $context["marginLeft"] = ((isset($context["level"]) || array_key_exists("level", $context) ? $context["level"] : (function () { throw new RuntimeError('Variable "level" does not exist.', 5, $this->source); })()) * 50);
            // line 6
            yield "    <div class=\"message-item\" style=\"background: rgba(255,255,255,0.0";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((5 - ((isset($context["level"]) || array_key_exists("level", $context) ? $context["level"] : (function () { throw new RuntimeError('Variable "level" does not exist.', 6, $this->source); })()) * 0.5)), "html", null, true);
            yield "); border-radius: 12px; padding: 25px; margin-bottom: 20px; border: 1px solid rgba(255,255,255,0.1); margin-left: ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["marginLeft"]) || array_key_exists("marginLeft", $context) ? $context["marginLeft"] : (function () { throw new RuntimeError('Variable "marginLeft" does not exist.', 6, $this->source); })()), "html", null, true);
            yield "px;\">
        <div class=\"message-header d-flex justify-content-between align-items-start mb-4\">
            <div class=\"author-info\">
                <strong class=\"text-white\">";
            // line 9
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["message"]) || array_key_exists("message", $context) ? $context["message"] : (function () { throw new RuntimeError('Variable "message" does not exist.', 9, $this->source); })()), "authorName", [], "any", false, false, false, 9), "html", null, true);
            yield "</strong>
                ";
            // line 10
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["message"]) || array_key_exists("message", $context) ? $context["message"] : (function () { throw new RuntimeError('Variable "message" does not exist.', 10, $this->source); })()), "isReply", [], "method", false, false, false, 10)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 11
                yield "                    <span class=\"badge bg-secondary ms-2\" style=\"font-size: 10px;\">Reply</span>
                ";
            }
            // line 13
            yield "                <div class=\"message-time\" style=\"color: rgba(255,255,255,0.6); font-size: 12px;\">
                    ";
            // line 14
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["message"]) || array_key_exists("message", $context) ? $context["message"] : (function () { throw new RuntimeError('Variable "message" does not exist.', 14, $this->source); })()), "createdAt", [], "any", false, false, false, 14), "M d, Y H:i"), "html", null, true);
            yield "
                </div>
            </div>
            <div class=\"message-actions d-flex align-items-center\">
                ";
            // line 18
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 18, $this->source); })()), "user", [], "any", false, false, false, 18)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 19
                yield "                    ";
                $context["userAuthorName"] = Twig\Extension\CoreExtension::trim(((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 19, $this->source); })()), "user", [], "any", false, false, false, 19), "firstName", [], "any", false, false, false, 19) . " ") . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 19, $this->source); })()), "user", [], "any", false, false, false, 19), "lastName", [], "any", false, false, false, 19)));
                // line 20
                yield "                    ";
                if ((((isset($context["userAuthorName"]) || array_key_exists("userAuthorName", $context) ? $context["userAuthorName"] : (function () { throw new RuntimeError('Variable "userAuthorName" does not exist.', 20, $this->source); })()) == CoreExtension::getAttribute($this->env, $this->source, (isset($context["message"]) || array_key_exists("message", $context) ? $context["message"] : (function () { throw new RuntimeError('Variable "message" does not exist.', 20, $this->source); })()), "authorName", [], "any", false, false, false, 20)) || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN"))) {
                    // line 21
                    yield "                        ";
                    if (((isset($context["userAuthorName"]) || array_key_exists("userAuthorName", $context) ? $context["userAuthorName"] : (function () { throw new RuntimeError('Variable "userAuthorName" does not exist.', 21, $this->source); })()) == CoreExtension::getAttribute($this->env, $this->source, (isset($context["message"]) || array_key_exists("message", $context) ? $context["message"] : (function () { throw new RuntimeError('Variable "message" does not exist.', 21, $this->source); })()), "authorName", [], "any", false, false, false, 21))) {
                        // line 22
                        yield "                            <a href=\"";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_edit_message", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["message"]) || array_key_exists("message", $context) ? $context["message"] : (function () { throw new RuntimeError('Variable "message" does not exist.', 22, $this->source); })()), "id", [], "any", false, false, false, 22)]), "html", null, true);
                        yield "\" class=\"btn btn-sm\" style=\"background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3); padding: 5px 10px; margin-right: 10px; border-radius: 5px;\">
                                <i class=\"fa fa-edit\"></i> Edit
                            </a>
                        ";
                    }
                    // line 26
                    yield "                        <form method=\"POST\" action=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_delete_message", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["message"]) || array_key_exists("message", $context) ? $context["message"] : (function () { throw new RuntimeError('Variable "message" does not exist.', 26, $this->source); })()), "id", [], "any", false, false, false, 26)]), "html", null, true);
                    yield "\" style=\"display: inline;\">
                            <input type=\"hidden\" name=\"_token\" value=\"";
                    // line 27
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete_message_" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["message"]) || array_key_exists("message", $context) ? $context["message"] : (function () { throw new RuntimeError('Variable "message" does not exist.', 27, $this->source); })()), "id", [], "any", false, false, false, 27))), "html", null, true);
                    yield "\">
                            <button type=\"submit\" class=\"btn btn-sm\" style=\"background: rgba(220,53,69,0.8); color: white; border: 1px solid rgba(220,53,69,0.5); padding: 5px 10px; margin-right: 10px; border-radius: 5px;\">
                                <i class=\"fa fa-trash\"></i> Delete
                            </button>
                        </form>
                    ";
                }
                // line 33
                yield "                    <div class=\"vote-buttons\">
                        <form method=\"POST\" action=\"";
                // line 34
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_vote", ["type" => "up", "id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["message"]) || array_key_exists("message", $context) ? $context["message"] : (function () { throw new RuntimeError('Variable "message" does not exist.', 34, $this->source); })()), "id", [], "any", false, false, false, 34)]), "html", null, true);
                yield "\" style=\"display: inline;\">
                            <button type=\"submit\" class=\"vote-btn upvote-btn\" style=\"background: none; border: none; color: #28a745; cursor: pointer; margin-right: 10px;\">
                                <i class=\"fa fa-thumbs-up\"></i> <span class=\"upvote-count\">";
                // line 36
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["message"]) || array_key_exists("message", $context) ? $context["message"] : (function () { throw new RuntimeError('Variable "message" does not exist.', 36, $this->source); })()), "upvoteCount", [], "any", false, false, false, 36), "html", null, true);
                yield "</span>
                            </button>
                        </form>
                        <form method=\"POST\" action=\"";
                // line 39
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_vote", ["type" => "down", "id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["message"]) || array_key_exists("message", $context) ? $context["message"] : (function () { throw new RuntimeError('Variable "message" does not exist.', 39, $this->source); })()), "id", [], "any", false, false, false, 39)]), "html", null, true);
                yield "\" style=\"display: inline;\">
                            <button type=\"submit\" class=\"vote-btn downvote-btn\" style=\"background: none; border: none; color: #dc3545; cursor: pointer;\">
                                <i class=\"fa fa-thumbs-down\"></i> <span class=\"downvote-count\">";
                // line 41
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["message"]) || array_key_exists("message", $context) ? $context["message"] : (function () { throw new RuntimeError('Variable "message" does not exist.', 41, $this->source); })()), "downvoteCount", [], "any", false, false, false, 41), "html", null, true);
                yield "</span>
                            </button>
                        </form>
                    </div>
                ";
            }
            // line 46
            yield "            </div>
        </div>
        <div class=\"message-content text-white-80 mb-4\" style=\"line-height: 1.7; font-size: 15px;\">
            ";
            // line 49
            yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["message"]) || array_key_exists("message", $context) ? $context["message"] : (function () { throw new RuntimeError('Variable "message" does not exist.', 49, $this->source); })()), "content", [], "any", false, false, false, 49), "html", null, true));
            yield "
        </div>
        
        <!-- Reply Button -->
        ";
            // line 53
            if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 53, $this->source); })()), "user", [], "any", false, false, false, 53) && ((isset($context["level"]) || array_key_exists("level", $context) ? $context["level"] : (function () { throw new RuntimeError('Variable "level" does not exist.', 53, $this->source); })()) < 3))) {
                // line 54
                yield "            <div class=\"reply-section mt-4\">
                <button type=\"button\" class=\"btn btn-sm reply-toggle\" data-message-id=\"";
                // line 55
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["message"]) || array_key_exists("message", $context) ? $context["message"] : (function () { throw new RuntimeError('Variable "message" does not exist.', 55, $this->source); })()), "id", [], "any", false, false, false, 55), "html", null, true);
                yield "\" style=\"background: rgba(102, 126, 234, 0.8); color: white; border: 1px solid rgba(102, 126, 234, 0.5); padding: 6px 18px; border-radius: 6px; font-size: 12px;\">
                    <i class=\"fa fa-reply\"></i> Reply
                </button>
                
                <!-- Reply Form (Hidden by default) -->
                <div class=\"reply-form-container\" id=\"reply-form-";
                // line 60
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["message"]) || array_key_exists("message", $context) ? $context["message"] : (function () { throw new RuntimeError('Variable "message" does not exist.', 60, $this->source); })()), "id", [], "any", false, false, false, 60), "html", null, true);
                yield "\" style=\"display: none; margin-top: 20px;\">
                    <form method=\"POST\" action=\"";
                // line 61
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("forum_reply_message", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["message"]) || array_key_exists("message", $context) ? $context["message"] : (function () { throw new RuntimeError('Variable "message" does not exist.', 61, $this->source); })()), "id", [], "any", false, false, false, 61)]), "html", null, true);
                yield "\">
                        <div class=\"mb-2\">
                            <textarea name=\"reply_message[content]\" class=\"form-control\" rows=\"3\" placeholder=\"Write your reply...\" style=\"background: white; color: #333; border: 1px solid #ddd; border-radius: 5px; padding: 8px;\"></textarea>
                        </div>
                        <div class=\"d-flex gap-2\">
                            <button type=\"submit\" class=\"btn btn-sm btn-primary\" style=\"background: #667eea; color: white; border: none; padding: 5px 15px; border-radius: 5px; font-size: 12px;\">
                                <i class=\"fa fa-paper-plane\"></i> Post Reply
                            </button>
                            <button type=\"button\" class=\"btn btn-sm btn-secondary reply-cancel\" data-message-id=\"";
                // line 69
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["message"]) || array_key_exists("message", $context) ? $context["message"] : (function () { throw new RuntimeError('Variable "message" does not exist.', 69, $this->source); })()), "id", [], "any", false, false, false, 69), "html", null, true);
                yield "\" style=\"background: #6c757d; color: white; border: none; padding: 5px 15px; border-radius: 5px; font-size: 12px;\">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        ";
            }
            // line 77
            yield "    </div>
    
    <!-- Render Replies -->
    ";
            // line 80
            if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["message"]) || array_key_exists("message", $context) ? $context["message"] : (function () { throw new RuntimeError('Variable "message" does not exist.', 80, $this->source); })()), "hasReplies", [], "method", false, false, false, 80) && ((isset($context["level"]) || array_key_exists("level", $context) ? $context["level"] : (function () { throw new RuntimeError('Variable "level" does not exist.', 80, $this->source); })()) < 3))) {
                // line 81
                yield "        ";
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["message"]) || array_key_exists("message", $context) ? $context["message"] : (function () { throw new RuntimeError('Variable "message" does not exist.', 81, $this->source); })()), "replies", [], "any", false, false, false, 81));
                foreach ($context['_seq'] as $context["_key"] => $context["reply"]) {
                    // line 82
                    yield "            ";
                    yield $macros["self"]->getTemplateForMacro("macro_renderMessage", $context, 82, $this->getSourceContext())->macro_renderMessage(...[$context["reply"], ((isset($context["level"]) || array_key_exists("level", $context) ? $context["level"] : (function () { throw new RuntimeError('Variable "level" does not exist.', 82, $this->source); })()) + 1), (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 82, $this->source); })())]);
                    yield "
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['reply'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 84
                yield "    ";
            }
            
            $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

            
            $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "forum/show.html.twig";
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
        return array (  1181 => 84,  1172 => 82,  1167 => 81,  1165 => 80,  1160 => 77,  1149 => 69,  1138 => 61,  1134 => 60,  1126 => 55,  1123 => 54,  1121 => 53,  1114 => 49,  1109 => 46,  1101 => 41,  1096 => 39,  1090 => 36,  1085 => 34,  1082 => 33,  1073 => 27,  1068 => 26,  1060 => 22,  1057 => 21,  1054 => 20,  1051 => 19,  1049 => 18,  1042 => 14,  1039 => 13,  1035 => 11,  1033 => 10,  1029 => 9,  1020 => 6,  1017 => 5,  1014 => 4,  994 => 3,  774 => 632,  446 => 306,  435 => 298,  429 => 294,  427 => 293,  422 => 291,  411 => 283,  407 => 282,  402 => 280,  398 => 278,  396 => 277,  391 => 274,  384 => 269,  381 => 268,  372 => 266,  367 => 265,  364 => 264,  362 => 263,  355 => 258,  349 => 257,  339 => 253,  330 => 252,  325 => 251,  321 => 250,  312 => 244,  307 => 241,  304 => 240,  294 => 233,  289 => 232,  281 => 228,  279 => 227,  276 => 226,  273 => 225,  270 => 224,  268 => 223,  264 => 221,  258 => 219,  256 => 218,  252 => 217,  248 => 216,  243 => 214,  221 => 194,  211 => 187,  201 => 181,  191 => 174,  182 => 168,  154 => 144,  152 => 143,  142 => 136,  136 => 135,  132 => 134,  128 => 133,  107 => 117,  76 => 88,  63 => 87,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% macro renderMessage(message, level, app) %}
    {% import _self as self %}
    {% set marginLeft = level * 50 %}
    <div class=\"message-item\" style=\"background: rgba(255,255,255,0.0{{ 5 - level * 0.5 }}); border-radius: 12px; padding: 25px; margin-bottom: 20px; border: 1px solid rgba(255,255,255,0.1); margin-left: {{ marginLeft }}px;\">
        <div class=\"message-header d-flex justify-content-between align-items-start mb-4\">
            <div class=\"author-info\">
                <strong class=\"text-white\">{{ message.authorName }}</strong>
                {% if message.isReply() %}
                    <span class=\"badge bg-secondary ms-2\" style=\"font-size: 10px;\">Reply</span>
                {% endif %}
                <div class=\"message-time\" style=\"color: rgba(255,255,255,0.6); font-size: 12px;\">
                    {{ message.createdAt|date('M d, Y H:i') }}
                </div>
            </div>
            <div class=\"message-actions d-flex align-items-center\">
                {% if app.user %}
                    {% set userAuthorName = (app.user.firstName ~ ' ' ~ app.user.lastName)|trim %}
                    {% if userAuthorName == message.authorName or is_granted('ROLE_ADMIN') %}
                        {% if userAuthorName == message.authorName %}
                            <a href=\"{{ path('forum_edit_message', {'id': message.id}) }}\" class=\"btn btn-sm\" style=\"background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3); padding: 5px 10px; margin-right: 10px; border-radius: 5px;\">
                                <i class=\"fa fa-edit\"></i> Edit
                            </a>
                        {% endif %}
                        <form method=\"POST\" action=\"{{ path('forum_delete_message', {'id': message.id}) }}\" style=\"display: inline;\">
                            <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete_message_' ~ message.id) }}\">
                            <button type=\"submit\" class=\"btn btn-sm\" style=\"background: rgba(220,53,69,0.8); color: white; border: 1px solid rgba(220,53,69,0.5); padding: 5px 10px; margin-right: 10px; border-radius: 5px;\">
                                <i class=\"fa fa-trash\"></i> Delete
                            </button>
                        </form>
                    {% endif %}
                    <div class=\"vote-buttons\">
                        <form method=\"POST\" action=\"{{ path('forum_vote', {'type': 'up', 'id': message.id}) }}\" style=\"display: inline;\">
                            <button type=\"submit\" class=\"vote-btn upvote-btn\" style=\"background: none; border: none; color: #28a745; cursor: pointer; margin-right: 10px;\">
                                <i class=\"fa fa-thumbs-up\"></i> <span class=\"upvote-count\">{{ message.upvoteCount }}</span>
                            </button>
                        </form>
                        <form method=\"POST\" action=\"{{ path('forum_vote', {'type': 'down', 'id': message.id}) }}\" style=\"display: inline;\">
                            <button type=\"submit\" class=\"vote-btn downvote-btn\" style=\"background: none; border: none; color: #dc3545; cursor: pointer;\">
                                <i class=\"fa fa-thumbs-down\"></i> <span class=\"downvote-count\">{{ message.downvoteCount }}</span>
                            </button>
                        </form>
                    </div>
                {% endif %}
            </div>
        </div>
        <div class=\"message-content text-white-80 mb-4\" style=\"line-height: 1.7; font-size: 15px;\">
            {{ message.content|nl2br }}
        </div>
        
        <!-- Reply Button -->
        {% if app.user and level < 3 %}
            <div class=\"reply-section mt-4\">
                <button type=\"button\" class=\"btn btn-sm reply-toggle\" data-message-id=\"{{ message.id }}\" style=\"background: rgba(102, 126, 234, 0.8); color: white; border: 1px solid rgba(102, 126, 234, 0.5); padding: 6px 18px; border-radius: 6px; font-size: 12px;\">
                    <i class=\"fa fa-reply\"></i> Reply
                </button>
                
                <!-- Reply Form (Hidden by default) -->
                <div class=\"reply-form-container\" id=\"reply-form-{{ message.id }}\" style=\"display: none; margin-top: 20px;\">
                    <form method=\"POST\" action=\"{{ path('forum_reply_message', {'id': message.id}) }}\">
                        <div class=\"mb-2\">
                            <textarea name=\"reply_message[content]\" class=\"form-control\" rows=\"3\" placeholder=\"Write your reply...\" style=\"background: white; color: #333; border: 1px solid #ddd; border-radius: 5px; padding: 8px;\"></textarea>
                        </div>
                        <div class=\"d-flex gap-2\">
                            <button type=\"submit\" class=\"btn btn-sm btn-primary\" style=\"background: #667eea; color: white; border: none; padding: 5px 15px; border-radius: 5px; font-size: 12px;\">
                                <i class=\"fa fa-paper-plane\"></i> Post Reply
                            </button>
                            <button type=\"button\" class=\"btn btn-sm btn-secondary reply-cancel\" data-message-id=\"{{ message.id }}\" style=\"background: #6c757d; color: white; border: none; padding: 5px 15px; border-radius: 5px; font-size: 12px;\">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        {% endif %}
    </div>
    
    <!-- Render Replies -->
    {% if message.hasReplies() and level < 3 %}
        {% for reply in message.replies %}
            {{ self.renderMessage(reply, level + 1, app) }}
        {% endfor %}
    {% endif %}
{% endmacro %}

{% block body %}
<div class=\"page-wrapper\">
    <!-- Preloader -->
    <div class=\"loader-wrap\">
        <div class=\"preloader\">
            <div class=\"preloader-close\">x</div>
            <div id=\"handle-preloader\" class=\"handle-preloader\">
                <div class=\"animation-preloader\">
                    <div class=\"txt-loading\">
                        <span data-text-preloader=\"L\" class=\"letters-loading\">L</span>
                        <span data-text-preloader=\"O\" class=\"letters-loading\">O</span>
                        <span data-text-preloader=\"A\" class=\"letters-loading\">A</span>
                        <span data-text-preloader=\"D\" class=\"letters-loading\">D</span>
                        <span data-text-preloader=\"I\" class=\"letters-loading\">I</span>
                        <span data-text-preloader=\"N\" class=\"letters-loading\">N</span>
                        <span data-text-preloader=\"G\" class=\"letters-loading\">G</span>
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
                    <div class=\"d-flex justify-content-between align-items-center flex-wrap\" style=\"display: flex; align-items: center; justify-content: space-between;\">
                        
                        <div class=\"logo-box\">
                            <div class=\"logo\"><a href=\"{{ path('app_homepage') }}\"><img src=\"{{ asset('assets_front/images/logo.svg') }}\" alt=\"\" title=\"\"></a></div>
                        </div>
                        
                        <div class=\"nav-outer d-flex flex-wrap align-items-center\">
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
                                        <li><a href=\"{{ path('forum_index') }}\">Forum</a></li>
                                        <li><a href=\"{{ path('forum_category', {'id': discussion.category.id}) }}\">{{ discussion.category.name }}</a></li>
                                        <li class=\"current\"><a href=\"#\">{{ discussion.title|slice(0, 30) }}...</a></li>
                                    </ul>
                                </div>
                            </nav>

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

    <!-- Discussion Content -->
    <section class=\"discussion-content\" style=\"padding: 120px 0 80px 0;\">
        <div class=\"auto-container\">
            <!-- Original Post -->
            <div class=\"original-post\" style=\"background: rgba(255,255,255,0.08); border-radius: 15px; padding: 40px; margin-bottom: 40px; border: 1px solid rgba(255,255,255,0.15);\">
                <div class=\"post-header mb-4\">
                    <div class=\"d-flex justify-content-between align-items-start\">
                        <div>
                            <h1 class=\"post-title text-white mb-4\">{{ discussion.title }}</h1>
                            <div class=\"post-meta\" style=\"color: rgba(255,255,255,0.7);\">
                                <span><i class=\"fa fa-user\"></i> {{ discussion.authorName }}</span>
                                <span class=\"ms-3\"><i class=\"fa fa-clock\"></i> {{ discussion.createdAt|date('M d, Y H:i') }}</span>
                                {% if discussion.updatedAt != discussion.createdAt %}
                                    <span class=\"ms-3\"><i class=\"fa fa-edit\"></i> Updated {{ discussion.updatedAt|date('M d, Y H:i') }}</span>
                                {% endif %}
                            </div>
                        </div>
                        {% if app.user %}
                            {% set userAuthorName = (app.user.firstName ~ ' ' ~ app.user.lastName)|trim %}
                            {% if userAuthorName == discussion.authorName or is_granted('ROLE_ADMIN') %}
                            <div class=\"post-actions d-flex gap-2\">
                                {% if userAuthorName == discussion.authorName %}
                                    <a href=\"{{ path('forum_edit_discussion', {'id': discussion.id}) }}\" class=\"btn btn-sm\" style=\"background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3); padding: 8px 15px; border-radius: 5px;\">
                                        <i class=\"fa fa-edit\"></i> Edit Discussion
                                    </a>
                                {% endif %}
                                <form method=\"POST\" action=\"{{ path('forum_delete_discussion', {'id': discussion.id}) }}\">
                                    <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete_discussion_' ~ discussion.id) }}\">
                                    <button type=\"submit\" class=\"btn btn-sm\" style=\"background: rgba(220,53,69,0.8); color: white; border: 1px solid rgba(220,53,69,0.5); padding: 8px 15px; border-radius: 5px;\">
                                        <i class=\"fa fa-trash\"></i> Delete Discussion
                                    </button>
                                </form>
                            </div>
                            {% endif %}
                        {% endif %}
                    </div>
                </div>
                <div class=\"post-content text-white-80\" style=\"line-height: 1.6;\">
                    {{ discussion.content|nl2br }}
                </div>

                            </div>

            <!-- Flash Messages -->
            {% for type, messages in app.flashes %}
                {% for message in messages %}
                    <div class=\"alert alert-{{ type == 'error' ? 'danger' : type }} alert-dismissible fade show mt-3\" style=\"background: {{ type == 'error' ? 'rgba(220,53,69,0.2)' : 'rgba(40,167,69,0.2)' }}; border: 1px solid {{ type == 'error' ? 'rgba(220,53,69,0.5)' : 'rgba(40,167,69,0.5)' }}; color: white; border-radius: 8px; padding: 15px;\">
                        {{ message }}
                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" style=\"filter: invert(1);\"></button>
                    </div>
                {% endfor %}
            {% endfor %}

            <!-- Messages Section -->
            <div class=\"messages-section\">
                <h3 class=\"text-white mb-5\">Replies</h3>

                {% if rootMessages %}
                    {% import _self as self %}
                    {% for message in rootMessages %}
                        {{ self.renderMessage(message, 0, app) }}
                    {% endfor %}
                {% else %}
                    <div class=\"no-messages text-center py-5\">
                        <i class=\"fa fa-comment-slash fa-3x mb-3\" style=\"color: rgba(255,255,255,0.3);\"></i>
                        <p class=\"text-white-50\">No replies yet. Be the first to reply!</p>
                    </div>
                {% endif %}
            </div>

            <!-- Reply Form -->
            {% if app.user and messageForm %}
                <div class=\"reply-form mt-5 pt-5\">
                    <h4 class=\"text-white mb-4\">Add Your Reply</h4>
                    {{ form_start(messageForm, {'attr': {'class': 'reply-form-ajax', 'data-discussion-id': discussion.id}}) }}
                        <div class=\"mb-3\">
                            {{ form_widget(messageForm.content, {'attr': {'class': 'form-control', 'rows': 4, 'placeholder': 'Write your reply here...', 'style': 'background: white; color: #333; border: 1px solid #ddd;'}}) }}
                            {{ form_errors(messageForm.content) }}
                        </div>
                        <button type=\"submit\" class=\"template-btn btn-style-one\">
                            <span class=\"btn-wrap\">
                                <span class=\"text-one\">Post Reply</span>
                                <span class=\"text-two\">Post Reply</span>
                            </span>
                        </button>
                    {{ form_end(messageForm) }}
                </div>
            {% elseif not app.user %}
                <div class=\"login-prompt text-center mt-5\" style=\"background: rgba(255,255,255,0.05); border-radius: 10px; padding: 30px; border: 1px solid rgba(255,255,255,0.1);\">
                    <i class=\"fa fa-lock fa-3x mb-3\" style=\"color: rgba(255,255,255,0.3);\"></i>
                    <h4 class=\"text-white mb-3\">Login to Reply</h4>
                    <p class=\"text-white-50 mb-4\">You need to be logged in to participate in discussions.</p>
                    <a href=\"{{ path('app_login') }}\" class=\"template-btn btn-style-one\">
                        <span class=\"btn-wrap\">
                            <span class=\"text-one\">Login Now</span>
                            <span class=\"text-two\">Login Now</span>
                        </span>
                    </a>
                </div>
            {% endif %}
        </div>
    </section>
</div>

<style>
.message-item:hover {
    background: rgba(255,255,255,0.08) !important;
}

.vote-btn:hover {
    opacity: 0.7;
}

.vote-btn.voted {
    font-weight: bold;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: \">\";
    color: rgba(255,255,255,0.6);
}

.text-white-80 {
    color: rgba(255,255,255,0.8) !important;
}

.text-white-80 {
    color: rgba(255,255,255,0.8) !important;
}

.text-white-50 {
    color: rgba(255,255,255,0.5) !important;
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

/* Discussion Layout Improvements */
.discussion-content {
    min-height: calc(100vh - 400px);
}

.original-post {
    position: relative;
    background: linear-gradient(135deg, rgba(255,255,255,0.08) 0%, rgba(255,255,255,0.05) 100%) !important;
    border: 1px solid rgba(255,255,255,0.15) !important;
    box-shadow: 0 8px 32px rgba(0,0,0,0.1);
}

.original-post::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    border-radius: 15px 15px 0 0;
}

.post-title {
    font-size: 32px;
    font-weight: 700;
    line-height: 1.3;
    margin-bottom: 20px !important;
}

.post-meta {
    font-size: 14px;
    opacity: 0.8;
}

.post-meta span {
    margin-right: 15px;
}

.messages-section {
    margin-top: 50px;
}

.messages-section h3 {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 30px !important;
    padding-bottom: 15px;
    border-bottom: 2px solid rgba(255,255,255,0.1);
}

.message-item {
    position: relative;
    background: rgba(255,255,255,0.08) !important;
    border: 1px solid rgba(255,255,255,0.1) !important;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.message-item:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 25px rgba(102, 126, 234, 0.1);
}

.message-header {
    border-bottom: 1px solid rgba(255,255,255,0.05);
    padding-bottom: 15px;
}

.author-info strong {
    font-size: 16px;
    font-weight: 600;
}

.message-time {
    font-size: 12px;
    opacity: 0.7;
    margin-top: 5px;
}

.message-content {
    font-size: 15px !important;
    line-height: 1.7 !important;
    word-wrap: break-word;
}

.reply-form {
    border-top: 2px solid rgba(255,255,255,0.1);
    padding-top: 40px !important;
    margin-top: 40px !important;
}

.reply-form h4 {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 25px !important;
}

.form-control {
    border-radius: 8px !important;
    border: 1px solid #ddd !important;
    padding: 12px 15px !important;
    font-size: 15px !important;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #667eea !important;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1) !important;
}

.reply-toggle {
    transition: all 0.3s ease;
}

.reply-toggle:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
}

.reply-form-container {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px;
    padding: 20px;
    margin-top: 20px !important;
}

.no-messages {
    background: rgba(255,255,255,0.03);
    border: 2px dashed rgba(255,255,255,0.1);
    border-radius: 15px;
    padding: 60px 30px !important;
    text-align: center;
}

.no-messages i {
    opacity: 0.5;
    margin-bottom: 20px !important;
}

.no-messages p {
    font-size: 16px;
    opacity: 0.7;
}

/* Header Alignment Fix */
.header-lower .inner-container > div {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
}

.logo-box {
    margin: 0 !important;
    padding: 0 !important;
}

.nav-outer {
    display: flex !important;
    align-items: center !important;
    margin: 0 !important;
}

.main-menu {
    margin: 0 !important;
}

.main-menu ul {
    margin: 0 !important;
    padding: 0 !important;
}

.outer-box {
    margin: 0 !important;
    padding: 0 !important;
}

.welcome-text {
    margin: 0 15px 0 0 !important;
    align-self: center !important;
}

.notification-dropdown {
    margin: 0 10px 0 0 !important;
    align-self: center !important;
}

.template-btn {
    margin: 0 0 0 10px !important;
    align-self: center !important;
}

</style>

<!-- Scripts -->
<script src=\"{{ asset('assets_front/js/jquery.js') }}\"></script>
<script>
\$(document).ready(function() {
    \$('.loader-wrap').fadeOut(500);

    // Handle reply form submission
    \$('.reply-form-ajax').submit(function(e) {
        e.preventDefault();
        
        var form = \$(this);
        var discussionId = form.data('discussion-id');
        var content = form.find('textarea[name=\"forum_message[content]\"]').val();
        
        \$.ajax({
            url: '/api/messages',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                discussionId: discussionId,
                content: content
            }),
            success: function(response) {
                if (response.success) {
                    // Add new message to the list
                    var newMessage = `
                        <div class=\"message-item\" style=\"background: rgba(255,255,255,0.05); border-radius: 10px; padding: 20px; margin-bottom: 15px; border: 1px solid rgba(255,255,255,0.1);\">
                            <div class=\"message-header d-flex justify-content-between align-items-start mb-3\">
                                <div class=\"author-info\">
                                    <strong class=\"text-white\">\${response.message.authorName}</strong>
                                    <div class=\"message-time\" style=\"color: rgba(255,255,255,0.6); font-size: 12px;\">
                                        \${response.message.createdAt}
                                    </div>
                                </div>
                                <div class=\"vote-buttons\">
                                    <form method=\"POST\" action=\"/forum/vote/up/\${response.message.id}\" style=\"display: inline;\">
                                        <button type=\"submit\" class=\"vote-btn upvote-btn\" style=\"background: none; border: none; color: #28a745; cursor: pointer; margin-right: 10px;\">
                                            <i class=\"fa fa-thumbs-up\"></i> <span class=\"upvote-count\">\${response.message.upvotes}</span>
                                        </button>
                                    </form>
                                    <form method=\"POST\" action=\"/forum/vote/down/\${response.message.id}\" style=\"display: inline;\">
                                        <button type=\"submit\" class=\"vote-btn downvote-btn\" style=\"background: none; border: none; color: #dc3545; cursor: pointer;\">
                                            <i class=\"fa fa-thumbs-down\"></i> <span class=\"downvote-count\">\${response.message.downvotes}</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class=\"message-content text-white-80\" style=\"line-height: 1.5;\">
                                \${response.message.content.replace(/\\n/g, '<br>')}
                            </div>
                        </div>
                    `;
                    
                    \$('.messages-section .no-messages').remove();
                    \$('.messages-section').append(newMessage);
                    
                    // Clear form
                    form.find('textarea').val('');
                    
                    // Update reply count
                    var replyCount = parseInt(\$('.messages-section h3').text().match(/\\d+/)[0]) + 1;
                    \$('.messages-section h3').text('Replies (' + replyCount + ')');
                }
            },
            error: function(xhr, status, errorThrown) {
                console.error('AJAX Error Status:', status);
                console.error('HTTP Status Code:', xhr.status);
                console.error('Error Thrown:', errorThrown);
                console.error('Response Text:', xhr.responseText);
                console.error('Response JSON:', xhr.responseJSON);
                
                var errorMsg = 'Server Error: ';
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    errorMsg += xhr.responseJSON.error;
                } else if (xhr.responseText) {
                    errorMsg += xhr.responseText.substring(0, 200);
                } else {
                    errorMsg += errorThrown || 'Unknown error';
                }
                alert(errorMsg);
            }
        });
    });
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

// Reply form toggle
\$(document).on('click', '.reply-toggle', function() {
    var messageId = \$(this).data('message-id');
    \$('#reply-form-' + messageId).slideToggle();
});

// Reply form cancel
\$(document).on('click', '.reply-cancel', function() {
    var messageId = \$(this).data('message-id');
    \$('#reply-form-' + messageId).slideUp();
});
</script>

{% endblock %}
", "forum/show.html.twig", "C:\\Users\\LordKiller\\Downloads\\user\\templates\\forum\\show.html.twig");
    }
}
