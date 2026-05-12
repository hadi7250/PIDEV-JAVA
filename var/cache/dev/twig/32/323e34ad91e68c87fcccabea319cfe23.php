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

/* security/base_auth.html.twig */
class __TwigTemplate_f8b442dcc38d0fba964fd84d3e96b069 extends Template
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

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'stylesheets' => [$this, 'block_stylesheets'],
            'body' => [$this, 'block_body'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "security/base_auth.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "security/base_auth.html.twig"));

        // line 1
        yield "<!doctype html>
<html lang=\"en\" data-bs-theme=\"blue-theme\">
<head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>";
        // line 6
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield "</title>
    
    <!--favicon-->
    <link rel=\"icon\" href=\"";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_auth/images/favicon-32x32.png"), "html", null, true);
        yield "\" type=\"image/png\">
    
    <!-- loader-->
    <link href=\"";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_auth/css/pace.min.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
    <script src=\"";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_auth/js/pace.min.js"), "html", null, true);
        yield "\"></script>

    <!--plugins-->
    <link href=\"";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_auth/plugins/perfect-scrollbar/css/perfect-scrollbar.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 17
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_auth/plugins/metismenu/metisMenu.min.css"), "html", null, true);
        yield "\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_auth/plugins/metismenu/mm-vertical.css"), "html", null, true);
        yield "\">
    
    <!--bootstrap css-->
    <link href=\"";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_auth/css/bootstrap.min.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
    <link href=\"https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap\" rel=\"stylesheet\">
    <link href=\"https://fonts.googleapis.com/css?family=Material+Icons+Outlined\" rel=\"stylesheet\">
    
    <!--main css-->
    <link href=\"";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_auth/css/bootstrap-extended.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
    <link href=\"";
        // line 27
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_auth/sass/main.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
    <link href=\"";
        // line 28
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_auth/sass/dark-theme.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
    <link href=\"";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_auth/sass/blue-theme.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
    <link href=\"";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_auth/sass/responsive.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
    
    <!-- Font Awesome -->
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css\">
    
    <style>
        @keyframes shake {
            0% { transform: translateX(0); }
            25% { transform: translateX(-6px); }
            50% { transform: translateX(6px); }
            75% { transform: translateX(-6px); }
            100% { transform: translateX(0); }
        }
    
        .shake {
            animation: shake 0.3s;
        }
    
        .is-invalid {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
        }
    
        .invalid-feedback {
            display: block !important;
        }
        
        .auth-logo {
            max-width: 180px;
            margin-bottom: 20px;
        }
    </style>
    
    ";
        // line 63
        yield from $this->unwrap()->yieldBlock('stylesheets', $context, $blocks);
        // line 64
        yield "</head>

<body>

    ";
        // line 68
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 69
        yield "
    <!--plugins-->
    <script src=\"https://code.jquery.com/jquery-3.6.4.min.js\"></script>
    <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js\"></script>
    <script src=\"";
        // line 73
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets_front/Login&SignUp/assets/js/main.js"), "html", null, true);
        yield "\"></script>
    
    <script>
        \$(document).ready(function () {
            // Toggle password show/hide
            \$(\".toggle-password\").on('click', function (event) {
                event.preventDefault();
                const input = \$(this).parent().find('input');
                const icon = \$(this).find('i');
                if (input.attr(\"type\") === \"text\") {
                    input.attr('type', 'password');
                    icon.removeClass(\"fa-eye\").addClass(\"fa-eye-slash\");
                } else {
                    input.attr('type', 'text');
                    icon.removeClass(\"fa-eye-slash\").addClass(\"fa-eye\");
                }
            });
        });
    </script>
    
    ";
        // line 93
        yield from $this->unwrap()->yieldBlock('javascripts', $context, $blocks);
        // line 94
        yield "</body>
</html>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 6
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

        yield "PIDEV Education - Authentication";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 63
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 68
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

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 93
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "security/base_auth.html.twig";
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
        return array (  275 => 93,  253 => 68,  231 => 63,  208 => 6,  196 => 94,  194 => 93,  171 => 73,  165 => 69,  163 => 68,  157 => 64,  155 => 63,  119 => 30,  115 => 29,  111 => 28,  107 => 27,  103 => 26,  95 => 21,  89 => 18,  85 => 17,  81 => 16,  75 => 13,  71 => 12,  65 => 9,  59 => 6,  52 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!doctype html>
<html lang=\"en\" data-bs-theme=\"blue-theme\">
<head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>{% block title %}PIDEV Education - Authentication{% endblock %}</title>
    
    <!--favicon-->
    <link rel=\"icon\" href=\"{{ asset('assets_auth/images/favicon-32x32.png') }}\" type=\"image/png\">
    
    <!-- loader-->
    <link href=\"{{ asset('assets_auth/css/pace.min.css') }}\" rel=\"stylesheet\">
    <script src=\"{{ asset('assets_auth/js/pace.min.js') }}\"></script>

    <!--plugins-->
    <link href=\"{{ asset('assets_auth/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}\" rel=\"stylesheet\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('assets_auth/plugins/metismenu/metisMenu.min.css') }}\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('assets_auth/plugins/metismenu/mm-vertical.css') }}\">
    
    <!--bootstrap css-->
    <link href=\"{{ asset('assets_auth/css/bootstrap.min.css') }}\" rel=\"stylesheet\">
    <link href=\"https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap\" rel=\"stylesheet\">
    <link href=\"https://fonts.googleapis.com/css?family=Material+Icons+Outlined\" rel=\"stylesheet\">
    
    <!--main css-->
    <link href=\"{{ asset('assets_auth/css/bootstrap-extended.css') }}\" rel=\"stylesheet\">
    <link href=\"{{ asset('assets_auth/sass/main.css') }}\" rel=\"stylesheet\">
    <link href=\"{{ asset('assets_auth/sass/dark-theme.css') }}\" rel=\"stylesheet\">
    <link href=\"{{ asset('assets_auth/sass/blue-theme.css') }}\" rel=\"stylesheet\">
    <link href=\"{{ asset('assets_auth/sass/responsive.css') }}\" rel=\"stylesheet\">
    
    <!-- Font Awesome -->
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css\">
    
    <style>
        @keyframes shake {
            0% { transform: translateX(0); }
            25% { transform: translateX(-6px); }
            50% { transform: translateX(6px); }
            75% { transform: translateX(-6px); }
            100% { transform: translateX(0); }
        }
    
        .shake {
            animation: shake 0.3s;
        }
    
        .is-invalid {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
        }
    
        .invalid-feedback {
            display: block !important;
        }
        
        .auth-logo {
            max-width: 180px;
            margin-bottom: 20px;
        }
    </style>
    
    {% block stylesheets %}{% endblock %}
</head>

<body>

    {% block body %}{% endblock %}

    <!--plugins-->
    <script src=\"https://code.jquery.com/jquery-3.6.4.min.js\"></script>
    <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js\"></script>
    <script src=\"{{ asset('assets_front/Login&SignUp/assets/js/main.js') }}\"></script>
    
    <script>
        \$(document).ready(function () {
            // Toggle password show/hide
            \$(\".toggle-password\").on('click', function (event) {
                event.preventDefault();
                const input = \$(this).parent().find('input');
                const icon = \$(this).find('i');
                if (input.attr(\"type\") === \"text\") {
                    input.attr('type', 'password');
                    icon.removeClass(\"fa-eye\").addClass(\"fa-eye-slash\");
                } else {
                    input.attr('type', 'text');
                    icon.removeClass(\"fa-eye-slash\").addClass(\"fa-eye\");
                }
            });
        });
    </script>
    
    {% block javascripts %}{% endblock %}
</body>
</html>", "security/base_auth.html.twig", "C:\\Users\\LordKiller\\Downloads\\user\\templates\\security\\base_auth.html.twig");
    }
}
