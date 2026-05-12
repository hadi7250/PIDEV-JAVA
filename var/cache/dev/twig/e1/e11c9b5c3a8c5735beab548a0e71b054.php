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

/* profile/index.html.twig */
class __TwigTemplate_86865f5d86a2fb4059ab994b3ce0254b extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "profile/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "profile/index.html.twig"));

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

        yield "Mon Profil - ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 3, $this->source); })()), "user", [], "any", false, false, false, 3), "name", [], "any", false, false, false, 3), "html", null, true);
        
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
        yield "<div class=\"container my-5\">
    <div class=\"row justify-content-center\">
        <div class=\"col-lg-8\">
            <div class=\"card shadow-lg border-0 rounded-4 overflow-hidden\">
                <!-- Header -->
                <div class=\"profile-header bg-gradient text-white text-center py-5\">
                    <img src=\"";
        // line 12
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 12, $this->source); })()), "user", [], "any", false, false, false, 12), "photo", [], "any", false, false, false, 12)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/profiles/" . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 12, $this->source); })()), "user", [], "any", false, false, false, 12), "photo", [], "any", false, false, false, 12))), "html", null, true)) : ("https://via.placeholder.com/150"));
        yield "\" alt=\"Photo de profil\" class=\"rounded-circle profile-avatar mb-3\" style=\"width:150px; height:150px; object-fit:cover; border:5px solid white;\">
                    <h2>";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::trim(((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 13, $this->source); })()), "user", [], "any", false, false, false, 13), "firstName", [], "any", false, false, false, 13) . " ") . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 13, $this->source); })()), "user", [], "any", false, false, false, 13), "lastName", [], "any", false, false, false, 13))), "html", null, true);
        yield "</h2>
                    <p class=\"lead\">";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), Twig\Extension\CoreExtension::replace(Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 14, $this->source); })()), "user", [], "any", false, false, false, 14), "roles", [], "any", false, false, false, 14)), ["ROLE_" => ""])), "html", null, true);
        yield "</p>
                    <p class=\"text-white-75\">";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 15, $this->source); })()), "user", [], "any", false, false, false, 15), "email", [], "any", false, false, false, 15), "html", null, true);
        yield "</p>
                </div>

                <!-- Flash message -->
                ";
        // line 19
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 19, $this->source); })()), "flashes", ["success"], "method", false, false, false, 19));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 20
            yield "                    <div class=\"alert alert-success alert-dismissible fade show mt-4\" role=\"alert\">
                        ";
            // line 21
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 25
        yield "
                <!-- Formulaire -->
                <div class=\"card-body p-5\">
                    <h3 class=\"mb-4 text-center\">Modifier mes informations</h3>
                    
                    ";
        // line 30
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 30, $this->source); })()), 'form_start', ["attr" => ["class" => "row g-3"]]);
        yield "
                        <div class=\"col-md-6\">
                            ";
        // line 32
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 32, $this->source); })()), "name", [], "any", false, false, false, 32), 'label', ["label_attr" => ["class" => "form-label"]]);
        yield "
                            ";
        // line 33
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 33, $this->source); })()), "name", [], "any", false, false, false, 33), 'widget', ["attr" => ["class" => "form-control"]]);
        yield "
                            ";
        // line 34
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 34, $this->source); })()), "name", [], "any", false, false, false, 34), 'errors');
        yield "
                        </div>
                        
                        <div class=\"col-md-6\">
                            ";
        // line 38
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 38, $this->source); })()), "email", [], "any", false, false, false, 38), 'label', ["label_attr" => ["class" => "form-label"]]);
        yield "
                            ";
        // line 39
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 39, $this->source); })()), "email", [], "any", false, false, false, 39), 'widget', ["attr" => ["class" => "form-control"]]);
        yield "
                            ";
        // line 40
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 40, $this->source); })()), "email", [], "any", false, false, false, 40), 'errors');
        yield "
                        </div>
                        
                                                
                        <div class=\"col-md-12 mb-4\">
                            <div class=\"text-center\">
                                <label class=\"form-label\">Photo de profil actuelle</label><br>
                                <img id=\"photo-preview\" src=\"";
        // line 47
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 47, $this->source); })()), "user", [], "any", false, false, false, 47), "photo", [], "any", false, false, false, 47)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/profiles/" . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 47, $this->source); })()), "user", [], "any", false, false, false, 47), "photo", [], "any", false, false, false, 47))), "html", null, true)) : ("https://via.placeholder.com/150"));
        yield "\" alt=\"Prévisualisation\" style=\"width:120px; height:120px; object-fit:cover; border-radius:50%; border: 3px solid #dee2e6;\">
                            </div>
                            ";
        // line 49
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 49, $this->source); })()), "photoFile", [], "any", false, false, false, 49), 'label', ["label_attr" => ["class" => "form-label"]]);
        yield "
                            ";
        // line 50
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 50, $this->source); })()), "photoFile", [], "any", false, false, false, 50), 'widget', ["attr" => ["class" => "form-control", "onchange" => "previewPhoto(event)"]]);
        yield "
                            ";
        // line 51
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 51, $this->source); })()), "photoFile", [], "any", false, false, false, 51), 'errors');
        yield "
                            <small class=\"text-muted\">Formats acceptés : JPG, PNG, GIF (max 2Mo)</small>
                        </div>
                        
                        <div class=\"col-md-6\">
                            ";
        // line 56
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 56, $this->source); })()), "plainPassword", [], "any", false, false, false, 56), "first", [], "any", false, false, false, 56), 'label', ["label_attr" => ["class" => "form-label"]]);
        yield "
                            ";
        // line 57
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 57, $this->source); })()), "plainPassword", [], "any", false, false, false, 57), "first", [], "any", false, false, false, 57), 'widget', ["attr" => ["class" => "form-control"]]);
        yield "
                            ";
        // line 58
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 58, $this->source); })()), "plainPassword", [], "any", false, false, false, 58), "first", [], "any", false, false, false, 58), 'errors');
        yield "
                        </div>
                        
                        <div class=\"col-md-6\">
                            ";
        // line 62
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 62, $this->source); })()), "plainPassword", [], "any", false, false, false, 62), "second", [], "any", false, false, false, 62), 'label', ["label_attr" => ["class" => "form-label"]]);
        yield "
                            ";
        // line 63
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 63, $this->source); })()), "plainPassword", [], "any", false, false, false, 63), "second", [], "any", false, false, false, 63), 'widget', ["attr" => ["class" => "form-control"]]);
        yield "
                            ";
        // line 64
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 64, $this->source); })()), "plainPassword", [], "any", false, false, false, 64), "second", [], "any", false, false, false, 64), 'errors');
        yield "
                        </div>
                        
                        <div class=\"col-12 text-center mt-4\">
                            <a href=\"";
        // line 68
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_homepage");
        yield "\" class=\"btn btn-outline-secondary btn-lg px-4 me-3\">
                                <i class=\"fas fa-arrow-left me-2\"></i> Retour à la page principale
                            </a>
                            <button type=\"submit\" class=\"btn btn-primary btn-lg px-5\">
                                <i class=\"fas fa-save me-2\"></i> Sauvegarder
                            </button>
                        </div>
                    ";
        // line 75
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 75, $this->source); })()), 'form_end');
        yield "
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewPhoto(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('photo-preview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
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
        return "profile/index.html.twig";
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
        return array (  251 => 75,  241 => 68,  234 => 64,  230 => 63,  226 => 62,  219 => 58,  215 => 57,  211 => 56,  203 => 51,  199 => 50,  195 => 49,  190 => 47,  180 => 40,  176 => 39,  172 => 38,  165 => 34,  161 => 33,  157 => 32,  152 => 30,  145 => 25,  135 => 21,  132 => 20,  128 => 19,  121 => 15,  117 => 14,  113 => 13,  109 => 12,  101 => 6,  88 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Mon Profil - {{ app.user.name }}{% endblock %}

{% block body %}
<div class=\"container my-5\">
    <div class=\"row justify-content-center\">
        <div class=\"col-lg-8\">
            <div class=\"card shadow-lg border-0 rounded-4 overflow-hidden\">
                <!-- Header -->
                <div class=\"profile-header bg-gradient text-white text-center py-5\">
                    <img src=\"{{ app.user.photo ? asset('uploads/profiles/' ~ app.user.photo) : 'https://via.placeholder.com/150' }}\" alt=\"Photo de profil\" class=\"rounded-circle profile-avatar mb-3\" style=\"width:150px; height:150px; object-fit:cover; border:5px solid white;\">
                    <h2>{{ (app.user.firstName ~ ' ' ~ app.user.lastName)|trim }}</h2>
                    <p class=\"lead\">{{ app.user.roles | first | replace({'ROLE_': ''}) | capitalize }}</p>
                    <p class=\"text-white-75\">{{ app.user.email }}</p>
                </div>

                <!-- Flash message -->
                {% for message in app.flashes('success') %}
                    <div class=\"alert alert-success alert-dismissible fade show mt-4\" role=\"alert\">
                        {{ message }}
                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
                    </div>
                {% endfor %}

                <!-- Formulaire -->
                <div class=\"card-body p-5\">
                    <h3 class=\"mb-4 text-center\">Modifier mes informations</h3>
                    
                    {{ form_start(form, {'attr': {'class': 'row g-3'}}) }}
                        <div class=\"col-md-6\">
                            {{ form_label(form.name, null, {'label_attr': {'class': 'form-label'}}) }}
                            {{ form_widget(form.name, {'attr': {'class': 'form-control'}}) }}
                            {{ form_errors(form.name) }}
                        </div>
                        
                        <div class=\"col-md-6\">
                            {{ form_label(form.email, null, {'label_attr': {'class': 'form-label'}}) }}
                            {{ form_widget(form.email, {'attr': {'class': 'form-control'}}) }}
                            {{ form_errors(form.email) }}
                        </div>
                        
                                                
                        <div class=\"col-md-12 mb-4\">
                            <div class=\"text-center\">
                                <label class=\"form-label\">Photo de profil actuelle</label><br>
                                <img id=\"photo-preview\" src=\"{{ app.user.photo ? asset('uploads/profiles/' ~ app.user.photo) : 'https://via.placeholder.com/150' }}\" alt=\"Prévisualisation\" style=\"width:120px; height:120px; object-fit:cover; border-radius:50%; border: 3px solid #dee2e6;\">
                            </div>
                            {{ form_label(form.photoFile, null, {'label_attr': {'class': 'form-label'}}) }}
                            {{ form_widget(form.photoFile, {'attr': {'class': 'form-control', 'onchange': 'previewPhoto(event)'}}) }}
                            {{ form_errors(form.photoFile) }}
                            <small class=\"text-muted\">Formats acceptés : JPG, PNG, GIF (max 2Mo)</small>
                        </div>
                        
                        <div class=\"col-md-6\">
                            {{ form_label(form.plainPassword.first, null, {'label_attr': {'class': 'form-label'}}) }}
                            {{ form_widget(form.plainPassword.first, {'attr': {'class': 'form-control'}}) }}
                            {{ form_errors(form.plainPassword.first) }}
                        </div>
                        
                        <div class=\"col-md-6\">
                            {{ form_label(form.plainPassword.second, null, {'label_attr': {'class': 'form-label'}}) }}
                            {{ form_widget(form.plainPassword.second, {'attr': {'class': 'form-control'}}) }}
                            {{ form_errors(form.plainPassword.second) }}
                        </div>
                        
                        <div class=\"col-12 text-center mt-4\">
                            <a href=\"{{ path('app_homepage') }}\" class=\"btn btn-outline-secondary btn-lg px-4 me-3\">
                                <i class=\"fas fa-arrow-left me-2\"></i> Retour à la page principale
                            </a>
                            <button type=\"submit\" class=\"btn btn-primary btn-lg px-5\">
                                <i class=\"fas fa-save me-2\"></i> Sauvegarder
                            </button>
                        </div>
                    {{ form_end(form) }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewPhoto(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('photo-preview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
}
</script>
{% endblock %}
", "profile/index.html.twig", "C:\\Users\\LordKiller\\Downloads\\user\\templates\\profile\\index.html.twig");
    }
}
