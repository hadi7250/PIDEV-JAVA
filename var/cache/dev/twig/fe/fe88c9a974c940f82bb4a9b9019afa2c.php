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

/* security/reset_password.html.twig */
class __TwigTemplate_c469a4040523d293b29022e7bfce5648 extends Template
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
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "security/reset_password.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "security/reset_password.html.twig"));

        // line 1
        yield "<!doctype html>
<html lang=\"en\" data-bs-theme=\"blue-theme\">

<head>
  <meta charset=\"utf-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
  <title>PIDEV Education - Reset Password</title>
  
  <!--favicon-->
  <link rel=\"icon\" href=\"";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/images/favicon-32x32.png"), "html", null, true);
        yield "\" type=\"image/png\">
  <!-- loader-->
  <link href=\"";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/css/pace.min.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
  <script src=\"";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/js/pace.min.js"), "html", null, true);
        yield "\"></script>

  <!--plugins-->
  <link href=\"";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
  <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 17
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/plugins/metismenu/metisMenu.min.css"), "html", null, true);
        yield "\">
  <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/plugins/metismenu/mm-vertical.css"), "html", null, true);
        yield "\">
  <!--bootstrap css-->
  <link href=\"";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/css/bootstrap.min.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
  <link href=\"https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap\" rel=\"stylesheet\">
  <link href=\"https://fonts.googleapis.com/css?family=Material+Icons+Outlined\" rel=\"stylesheet\">
  <!--main css-->
  <link href=\"";
        // line 24
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/css/bootstrap-extended.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
  <link href=\"";
        // line 25
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/sass/main.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
  <link href=\"";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/sass/dark-theme.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
  <link href=\"";
        // line 27
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/sass/blue-theme.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
  <link href=\"";
        // line 28
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/sass/responsive.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">

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
    
    body {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      font-family: 'Noto Sans', sans-serif;
    }
    
    .btn-grd-danger {
      background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
      border: none;
      color: white;
      padding: 12px 24px;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    
    .btn-grd-danger:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(240, 147, 251, 0.3);
      color: white;
    }
    
    .btn-light {
      background: white;
      border: 2px solid #e0e0e0;
      color: #333;
      padding: 12px 24px;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    
    .btn-light:hover {
      border-color: #f093fb;
      background: #f8f9fa;
      transform: translateY(-1px);
    }
    
    .bg-grd-danger {
      background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }
    
    .card {
      border: none;
      box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }
    
    .form-control {
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      padding: 12px 16px;
      transition: all 0.3s ease;
    }
    
    .form-control:focus {
      border-color: #f093fb;
      box-shadow: 0 0 0 0.25rem rgba(240, 147, 251, 0.25);
    }
    
    .form-label {
      font-weight: 600;
      color: #333;
      margin-bottom: 8px;
    }
  </style>
</head>

<body>

  <!--authentication-->

  <div class=\"mx-3 mx-lg-0\">

  <div class=\"card my-5 col-xl-9 col-xxl-8 mx-auto rounded-4 overflow-hidden p-4\">
    <div class=\"row g-4 align-items-center\">
      <div class=\"col-lg-6 d-flex\">
        <div class=\"card-body\">
          <img src=\"";
        // line 129
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/images/logo1.png"), "html", null, true);
        yield "\" class=\"mb-4\" width=\"145\" alt=\"\">
          <h4 class=\"fw-bold\">Generate New Password</h4>
          <p class=\"mb-0\">We received your reset password request. Please enter your new password!</p>
          
          ";
        // line 133
        if ((($tmp = (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 133, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 134
            yield "            <div class=\"alert alert-danger\" role=\"alert\">
              ";
            // line 135
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 135, $this->source); })()), "html", null, true);
            yield "
            </div>
          ";
        }
        // line 138
        yield "          
          ";
        // line 139
        if ((($tmp = (isset($context["success"]) || array_key_exists("success", $context) ? $context["success"] : (function () { throw new RuntimeError('Variable "success" does not exist.', 139, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 140
            yield "            <div class=\"alert alert-success\" role=\"alert\">
              ";
            // line 141
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["success"]) || array_key_exists("success", $context) ? $context["success"] : (function () { throw new RuntimeError('Variable "success" does not exist.', 141, $this->source); })()), "html", null, true);
            yield "
            </div>
          ";
        }
        // line 144
        yield "
          <div class=\"form-body mt-4\">
            <form class=\"row g-3\" method=\"post\">
              <div class=\"col-12\">
                <label class=\"form-label\" for=\"password\">New Password</label>
                <input type=\"password\" name=\"password\" class=\"form-control\" id=\"password\" placeholder=\"Enter new password\" required>
              </div>
              <div class=\"col-12\">
                <label class=\"form-label\" for=\"confirm_password\">Confirm Password</label>
                <input type=\"password\" name=\"confirm_password\" class=\"form-control\" id=\"confirm_password\" placeholder=\"Confirm password\" required>
              </div>
              <div class=\"col-12\">
                <div class=\"d-grid gap-2\">
                  <button type=\"submit\" class=\"btn btn-grd-danger\">Change Password</button>
                   <a href=\"";
        // line 158
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
        yield "\" class=\"btn btn-light\">Back to Login</a>
                </div>
              </div>
            </form>
          </div>

      </div>
      </div>
      <div class=\"col-lg-6 d-lg-flex d-none\">
        <div class=\"p-3 rounded-4 w-100 d-flex align-items-center justify-content-center bg-grd-danger\">
          <img src=\"";
        // line 168
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/images/auth/reset-password1.png"), "html", null, true);
        yield "\" class=\"img-fluid\" alt=\"\">
        </div>
      </div>

    </div><!--end row-->
  </div>

</div>




  <!--authentication-->


  <!--plugins-->
  <script src=\"";
        // line 184
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/js/jquery.min.js"), "html", null, true);
        yield "\"></script>

  <script>
    \$(document).ready(function () {
      // Form validation
      \$('form').on('submit', function(e) {
        var password = \$('#password').val().trim();
        var confirmPassword = \$('#confirm_password').val().trim();
        
        // Clear previous errors
        \$('.is-invalid').removeClass('is-invalid');
        \$('.invalid-feedback').remove();
        
        // Validate passwords
        if (!password) {
          \$('#password').addClass('is-invalid shake');
          \$('#password').after('<div class=\"invalid-feedback\">Password is required</div>');
          e.preventDefault();
          return false;
        }
        
        if (password.length < 6) {
          \$('#password').addClass('is-invalid shake');
          \$('#password').after('<div class=\"invalid-feedback\">Password must be at least 6 characters</div>');
          e.preventDefault();
          return false;
        }
        
        if (!confirmPassword) {
          \$('#confirm_password').addClass('is-invalid shake');
          \$('#confirm_password').after('<div class=\"invalid-feedback\">Please confirm your password</div>');
          e.preventDefault();
          return false;
        }
        
        if (password !== confirmPassword) {
          \$('#confirm_password').addClass('is-invalid shake');
          \$('#confirm_password').after('<div class=\"invalid-feedback\">Passwords do not match</div>');
          e.preventDefault();
          return false;
        }
      });
      
      // Remove error on input
      \$('#password, #confirm_password').on('input', function() {
        \$(this).removeClass('is-invalid shake');
        \$(this).next('.invalid-feedback').remove();
      });
    });
  </script>

</body>
</html>
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "security/reset_password.html.twig";
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
        return array (  294 => 184,  275 => 168,  262 => 158,  246 => 144,  240 => 141,  237 => 140,  235 => 139,  232 => 138,  226 => 135,  223 => 134,  221 => 133,  214 => 129,  110 => 28,  106 => 27,  102 => 26,  98 => 25,  94 => 24,  87 => 20,  82 => 18,  78 => 17,  74 => 16,  68 => 13,  64 => 12,  59 => 10,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!doctype html>
<html lang=\"en\" data-bs-theme=\"blue-theme\">

<head>
  <meta charset=\"utf-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
  <title>PIDEV Education - Reset Password</title>
  
  <!--favicon-->
  <link rel=\"icon\" href=\"{{ asset('Back_Office/assets/images/favicon-32x32.png') }}\" type=\"image/png\">
  <!-- loader-->
  <link href=\"{{ asset('Back_Office/assets/css/pace.min.css') }}\" rel=\"stylesheet\">
  <script src=\"{{ asset('Back_Office/assets/js/pace.min.js') }}\"></script>

  <!--plugins-->
  <link href=\"{{ asset('Back_Office/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}\" rel=\"stylesheet\">
  <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('Back_Office/assets/plugins/metismenu/metisMenu.min.css') }}\">
  <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('Back_Office/assets/plugins/metismenu/mm-vertical.css') }}\">
  <!--bootstrap css-->
  <link href=\"{{ asset('Back_Office/assets/css/bootstrap.min.css') }}\" rel=\"stylesheet\">
  <link href=\"https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap\" rel=\"stylesheet\">
  <link href=\"https://fonts.googleapis.com/css?family=Material+Icons+Outlined\" rel=\"stylesheet\">
  <!--main css-->
  <link href=\"{{ asset('Back_Office/assets/css/bootstrap-extended.css') }}\" rel=\"stylesheet\">
  <link href=\"{{ asset('Back_Office/sass/main.css') }}\" rel=\"stylesheet\">
  <link href=\"{{ asset('Back_Office/sass/dark-theme.css') }}\" rel=\"stylesheet\">
  <link href=\"{{ asset('Back_Office/sass/blue-theme.css') }}\" rel=\"stylesheet\">
  <link href=\"{{ asset('Back_Office/sass/responsive.css') }}\" rel=\"stylesheet\">

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
    
    body {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      font-family: 'Noto Sans', sans-serif;
    }
    
    .btn-grd-danger {
      background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
      border: none;
      color: white;
      padding: 12px 24px;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    
    .btn-grd-danger:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(240, 147, 251, 0.3);
      color: white;
    }
    
    .btn-light {
      background: white;
      border: 2px solid #e0e0e0;
      color: #333;
      padding: 12px 24px;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    
    .btn-light:hover {
      border-color: #f093fb;
      background: #f8f9fa;
      transform: translateY(-1px);
    }
    
    .bg-grd-danger {
      background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }
    
    .card {
      border: none;
      box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }
    
    .form-control {
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      padding: 12px 16px;
      transition: all 0.3s ease;
    }
    
    .form-control:focus {
      border-color: #f093fb;
      box-shadow: 0 0 0 0.25rem rgba(240, 147, 251, 0.25);
    }
    
    .form-label {
      font-weight: 600;
      color: #333;
      margin-bottom: 8px;
    }
  </style>
</head>

<body>

  <!--authentication-->

  <div class=\"mx-3 mx-lg-0\">

  <div class=\"card my-5 col-xl-9 col-xxl-8 mx-auto rounded-4 overflow-hidden p-4\">
    <div class=\"row g-4 align-items-center\">
      <div class=\"col-lg-6 d-flex\">
        <div class=\"card-body\">
          <img src=\"{{ asset('Back_Office/assets/images/logo1.png') }}\" class=\"mb-4\" width=\"145\" alt=\"\">
          <h4 class=\"fw-bold\">Generate New Password</h4>
          <p class=\"mb-0\">We received your reset password request. Please enter your new password!</p>
          
          {% if error %}
            <div class=\"alert alert-danger\" role=\"alert\">
              {{ error }}
            </div>
          {% endif %}
          
          {% if success %}
            <div class=\"alert alert-success\" role=\"alert\">
              {{ success }}
            </div>
          {% endif %}

          <div class=\"form-body mt-4\">
            <form class=\"row g-3\" method=\"post\">
              <div class=\"col-12\">
                <label class=\"form-label\" for=\"password\">New Password</label>
                <input type=\"password\" name=\"password\" class=\"form-control\" id=\"password\" placeholder=\"Enter new password\" required>
              </div>
              <div class=\"col-12\">
                <label class=\"form-label\" for=\"confirm_password\">Confirm Password</label>
                <input type=\"password\" name=\"confirm_password\" class=\"form-control\" id=\"confirm_password\" placeholder=\"Confirm password\" required>
              </div>
              <div class=\"col-12\">
                <div class=\"d-grid gap-2\">
                  <button type=\"submit\" class=\"btn btn-grd-danger\">Change Password</button>
                   <a href=\"{{ path('app_login') }}\" class=\"btn btn-light\">Back to Login</a>
                </div>
              </div>
            </form>
          </div>

      </div>
      </div>
      <div class=\"col-lg-6 d-lg-flex d-none\">
        <div class=\"p-3 rounded-4 w-100 d-flex align-items-center justify-content-center bg-grd-danger\">
          <img src=\"{{ asset('Back_Office/assets/images/auth/reset-password1.png') }}\" class=\"img-fluid\" alt=\"\">
        </div>
      </div>

    </div><!--end row-->
  </div>

</div>




  <!--authentication-->


  <!--plugins-->
  <script src=\"{{ asset('Back_Office/assets/js/jquery.min.js') }}\"></script>

  <script>
    \$(document).ready(function () {
      // Form validation
      \$('form').on('submit', function(e) {
        var password = \$('#password').val().trim();
        var confirmPassword = \$('#confirm_password').val().trim();
        
        // Clear previous errors
        \$('.is-invalid').removeClass('is-invalid');
        \$('.invalid-feedback').remove();
        
        // Validate passwords
        if (!password) {
          \$('#password').addClass('is-invalid shake');
          \$('#password').after('<div class=\"invalid-feedback\">Password is required</div>');
          e.preventDefault();
          return false;
        }
        
        if (password.length < 6) {
          \$('#password').addClass('is-invalid shake');
          \$('#password').after('<div class=\"invalid-feedback\">Password must be at least 6 characters</div>');
          e.preventDefault();
          return false;
        }
        
        if (!confirmPassword) {
          \$('#confirm_password').addClass('is-invalid shake');
          \$('#confirm_password').after('<div class=\"invalid-feedback\">Please confirm your password</div>');
          e.preventDefault();
          return false;
        }
        
        if (password !== confirmPassword) {
          \$('#confirm_password').addClass('is-invalid shake');
          \$('#confirm_password').after('<div class=\"invalid-feedback\">Passwords do not match</div>');
          e.preventDefault();
          return false;
        }
      });
      
      // Remove error on input
      \$('#password, #confirm_password').on('input', function() {
        \$(this).removeClass('is-invalid shake');
        \$(this).next('.invalid-feedback').remove();
      });
    });
  </script>

</body>
</html>
", "security/reset_password.html.twig", "C:\\Users\\LordKiller\\Downloads\\user\\templates\\security\\reset_password.html.twig");
    }
}
