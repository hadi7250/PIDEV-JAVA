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

/* security/login.html.twig */
class __TwigTemplate_c3d19ed2da13e685f8ab423dcb900e4e extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "security/login.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "security/login.html.twig"));

        // line 1
        yield "<!doctype html>
<html lang=\"en\" data-bs-theme=\"blue-theme\">

<head>
  <meta charset=\"utf-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
  <title>PIDEV Education - Login</title>
  
  <!-- Bootstrap CSS -->
  <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
  <!-- Font Awesome -->
  <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css\">
  
  <!-- Dashboard CSS for consistent styling -->
  <link href=\"";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/css/bootstrap.min.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
  <link href=\"";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/css/bootstrap-extended.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
  <link href=\"";
        // line 17
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/sass/main.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
  <link href=\"";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/sass/blue-theme.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
  <link href=\"";
        // line 19
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/sass/responsive.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
  
  <!-- Google Fonts -->
  <link href=\"https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap\" rel=\"stylesheet\">
  <link href=\"https://fonts.googleapis.com/css?family=Material+Icons+Outlined\" rel=\"stylesheet\">

  <script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script>

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
    
    .btn-grd-primary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      color: white;
      padding: 12px 24px;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    
    .btn-grd-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
      color: white;
    }
    
    .btn-filter {
      background: white;
      border: 2px solid #e0e0e0;
      color: #333;
      padding: 12px 24px;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    
    .btn-filter:hover {
      border-color: #667eea;
      background: #f8f9fa;
      transform: translateY(-1px);
    }
    
    .separator {
      display: flex;
      align-items: center;
      margin: 30px 0;
      color: #666;
    }
    
    .separator .line {
      flex: 1;
      height: 1px;
      background: #e0e0e0;
    }
    
    .separator p {
      padding: 0 15px;
      margin: 0;
      font-size: 14px;
    }
    
    .bg-grd-primary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
      border-color: #667eea;
      box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
    }
    
    .input-group-text {
      border: 2px solid #e0e0e0;
      border-left: none;
      background: transparent;
      color: #666;
    }
    
    .form-control.border-end-0 {
      border-right: none;
    }
  </style>
  
  <script src=\"https://code.jquery.com/jquery-3.6.4.min.js\"></script>
</head>
  
<body>
  <!--authentication-->
  <div class=\"mx-3 mx-lg-0\">
    <div class=\"card my-5 col-xl-9 col-xxl-8 mx-auto rounded-4 overflow-hidden p-4\">
      <div class=\"row g-4\">
        <div class=\"col-lg-6 d-flex\">
          <div class=\"card-body\">
            <img src=\"";
        // line 149
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/images/logo-icon.png"), "html", null, true);
        yield "\" class=\"mb-4\" width=\"145\" alt=\"PIDEV Education\">
            <h4 class=\"fw-bold\">Get Started Now</h4>
            <p class=\"mb-0\">Enter your credentials to login your account</p>
            
            <div class=\"row gy-2 gx-0 my-4\">
              <div class=\"col-12 col-lg-12\">
                <a href=\"";
        // line 155
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("connect_google");
        yield "\" class=\"btn btn-filter py-2 px-4 font-text1 fw-bold d-flex align-items-center justify-content-center w-100 text-decoration-none\">
                  <span class=\"\"><i class=\"fab fa-google me-2\"></i>Sign in with Google</span>
                </a>
              </div>
              <div class=\"col-12 col-lg-12\">
                <button class=\"btn btn-filter py-2 px-4 font-text1 fw-bold d-flex align-items-center justify-content-center w-100\">
                  <span class=\"\"><i class=\"fab fa-facebook-f me-2\"></i>Sign in with Facebook</span>
                </button>
              </div>
              <div class=\"col-12 col-lg-12\">
                <button class=\"btn btn-filter py-2 px-4 font-text1 fw-bold d-flex align-items-center justify-content-center w-100\">
                  <span class=\"\"><i class=\"fab fa-linkedin-in me-2\"></i>Sign in with LinkedIn</span>
                </button>
              </div>
            </div>

            <div class=\"separator\">
              <div class=\"line\"></div>
              <p class=\"mb-0 fw-bold\">OR SIGN IN WITH</p>
              <div class=\"line\"></div>
            </div>
            
            <div class=\"form-body mt-4\">
              <form method=\"post\" action=\"";
        // line 178
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
        yield "\" novalidate=\"novalidate\" class=\"row g-3\">
                ";
        // line 179
        if ((($tmp = (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 179, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 180
            yield "                  <div class=\"col-12\">
                    <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                      ";
            // line 182
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 182, $this->source); })()), "messageKey", [], "any", false, false, false, 182), CoreExtension::getAttribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 182, $this->source); })()), "messageData", [], "any", false, false, false, 182), "security"), "html", null, true);
            yield "
                      <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
                    </div>
                  </div>
                ";
        }
        // line 187
        yield "                
                ";
        // line 188
        if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 188, $this->source); })()), "user", [], "any", false, false, false, 188)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 189
            yield "                  ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 189, $this->source); })()), "session", [], "any", false, false, false, 189), "flashbag", [], "any", false, false, false, 189), "all", [], "method", false, false, false, 189));
            foreach ($context['_seq'] as $context["type"] => $context["messages"]) {
                // line 190
                yield "                    ";
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
                foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                    // line 191
                    yield "                      <div class=\"col-12\">
                        <div class=\"alert alert-";
                    // line 192
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["type"], "html", null, true);
                    yield " alert-dismissible fade show\" role=\"alert\">
                          ";
                    // line 193
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
                    yield "
                          <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
                        </div>
                      </div>
                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 198
                yield "                  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['type'], $context['messages'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 199
            yield "                ";
        }
        // line 200
        yield "                
                ";
        // line 201
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 201, $this->source); })()), "user", [], "any", false, false, false, 201)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 202
            yield "                  <div class=\"col-12\">
                    <div class=\"alert alert-info\">
                      You are logged in as ";
            // line 204
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 204, $this->source); })()), "user", [], "any", false, false, false, 204), "email", [], "any", false, false, false, 204), "html", null, true);
            yield ", <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
            yield "\">Logout</a>
                    </div>
                  </div>
                ";
        }
        // line 208
        yield "                
                <div class=\"col-12\">
                  <label for=\"inputEmailAddress\" class=\"form-label\">Email</label>
                  <input type=\"email\" class=\"form-control\" id=\"inputEmailAddress\" name=\"_username\" 
                         value=\"";
        // line 212
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["last_username"]) || array_key_exists("last_username", $context) ? $context["last_username"] : (function () { throw new RuntimeError('Variable "last_username" does not exist.', 212, $this->source); })()), "html", null, true);
        yield "\" placeholder=\"jhon@example.com\" autofocus>
                </div>
                
                <div class=\"col-12\">
                  <label for=\"inputChoosePassword\" class=\"form-label\">Password</label>
                  <div class=\"input-group\" id=\"show_hide_password\">
                    <input type=\"password\" class=\"form-control border-end-0\" id=\"inputChoosePassword\" 
                           name=\"_password\" placeholder=\"Enter Password\">
                    <a href=\"javascript:;\" class=\"input-group-text bg-transparent\">
                      <i class=\"bi bi-eye-slash-fill\"></i>
                    </a>
                  </div>
                </div>
                
                <div class=\"col-md-6\">
                  <div class=\"form-check form-switch\">
                    <input class=\"form-check-input\" type=\"checkbox\" id=\"flexSwitchCheckChecked\" name=\"_remember_me\">
                    <label class=\"form-check-label\" for=\"flexSwitchCheckChecked\">Remember Me</label>
                  </div>
                </div>
                
                <div class=\"col-md-6 text-end\">
                  <a href=\"";
        // line 234
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_forgot_password");
        yield "\" class=\"text-decoration-none\">Forgot Password ?</a>
                  <br>
                  <small class=\"text-muted\">
                    <a href=\"https://accounts.google.com/Logout\" target=\"_blank\" class=\"text-decoration-none\">Logout from Google</a>
                  </small>
                </div>
                
                <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 241
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("authenticate"), "html", null, true);
        yield "\">
                
                <div class=\"col-12\">
                  <div class=\"d-grid\">
                    <button type=\"submit\" class=\"btn btn-grd-primary\">Login</button>
                  </div>
                </div>
                
                <div class=\"col-12\">
                  <div class=\"text-start\">
                    <p class=\"mb-0\">Don't have an account yet? <a href=\"";
        // line 251
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
        yield "\" class=\"text-decoration-none\">Sign up here</a></p>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        
        <div class=\"col-lg-6 d-lg-flex d-none\">
          <div class=\"p-3 rounded-4 w-100 d-flex align-items-center justify-content-center bg-grd-primary\">
            <img src=\"";
        // line 261
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/images/auth/login1.png"), "html", null, true);
        yield "\" class=\"img-fluid\" alt=\"Login Illustration\">
          </div>
        </div>
      </div><!--end row-->
    </div>
  </div>
  <!--authentication-->

  <!-- Bootstrap JS -->
  <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js\"></script>
  
  <script>
   \$(document).ready(function () {
     // Clear the password field on page load
     \$('#inputChoosePassword').val('');

     // Toggle password show/hide
     \$(\"#show_hide_password a\").on('click', function (event) {
       event.preventDefault();
       const input = \$('#show_hide_password input');
       const icon = \$('#show_hide_password i');
       if (input.attr(\"type\") === \"text\") {
         input.attr('type', 'password');
         icon.addClass(\"bi-eye-slash-fill\").removeClass(\"bi-eye-fill\");
       } else {
         input.attr('type', 'text');
         icon.removeClass(\"bi-eye-slash-fill\").addClass(\"bi-eye-fill\");
       }
     });

     // Validation functions
     function validateEmail(email) {
       const re = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+\$/;
       return re.test(email);
     }

     function showError(input, message) {
       const \$input = \$(input);
       \$input.addClass('is-invalid');
       \$input.removeClass('shake');
       void \$input[0].offsetWidth; // force reflow
       \$input.addClass('shake');

       if (!\$input.next('.invalid-feedback').length) {
         \$input.after(`<div class=\"invalid-feedback\">\${message}</div>`);
       } else {
         \$input.next('.invalid-feedback').text(message);
       }
     }

     function clearError(input) {
       const \$input = \$(input);
       \$input.removeClass('is-invalid shake');
       \$input.next('.invalid-feedback').remove();
     }

     // Live validation on typing for Email
     \$('#inputEmailAddress').on('input', function () {
       const email = \$(this).val().trim();
       if (email === '') {
         clearError(this);
       } else if (!email.includes('@')) {
         showError(this, \"Missing @ symbol.\");
       } else if (email.indexOf('@') !== email.lastIndexOf('@')) {
         showError(this, \"Only one @ symbol is allowed.\");
       } else if (email.split('@')[1].length < 1) {
         showError(this, \"Missing characters after @.\");
       } else if (email.split('@')[1] && !email.split('@')[1].includes('.')) {
         showError(this, \"Missing domain extension (e.g., .com).\");
       } else if (!validateEmail(email)) {
         showError(this, \"Enter a valid email.\");
       } else {
         clearError(this);
       }
     });

     // Live validation on typing for Password
     \$('#inputChoosePassword').on('input', function () {
       const password = \$(this).val().trim();
       if (password === '') {
         clearError(this);
       } else if (password.length < 6) {
         showError(this, \"Minimum 6 characters.\");
       } else {
         clearError(this);
       }
     });

     // Initial validation on page load (no errors should be shown)
     \$('#inputEmailAddress').trigger('input');
     \$('#inputChoosePassword').trigger('input');
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
        return "security/login.html.twig";
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
        return array (  393 => 261,  380 => 251,  367 => 241,  357 => 234,  332 => 212,  326 => 208,  317 => 204,  313 => 202,  311 => 201,  308 => 200,  305 => 199,  299 => 198,  288 => 193,  284 => 192,  281 => 191,  276 => 190,  271 => 189,  269 => 188,  266 => 187,  258 => 182,  254 => 180,  252 => 179,  248 => 178,  222 => 155,  213 => 149,  80 => 19,  76 => 18,  72 => 17,  68 => 16,  64 => 15,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!doctype html>
<html lang=\"en\" data-bs-theme=\"blue-theme\">

<head>
  <meta charset=\"utf-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
  <title>PIDEV Education - Login</title>
  
  <!-- Bootstrap CSS -->
  <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
  <!-- Font Awesome -->
  <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css\">
  
  <!-- Dashboard CSS for consistent styling -->
  <link href=\"{{ asset('Back_Office/assets/css/bootstrap.min.css') }}\" rel=\"stylesheet\">
  <link href=\"{{ asset('Back_Office/assets/css/bootstrap-extended.css') }}\" rel=\"stylesheet\">
  <link href=\"{{ asset('Back_Office/sass/main.css') }}\" rel=\"stylesheet\">
  <link href=\"{{ asset('Back_Office/sass/blue-theme.css') }}\" rel=\"stylesheet\">
  <link href=\"{{ asset('Back_Office/sass/responsive.css') }}\" rel=\"stylesheet\">
  
  <!-- Google Fonts -->
  <link href=\"https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap\" rel=\"stylesheet\">
  <link href=\"https://fonts.googleapis.com/css?family=Material+Icons+Outlined\" rel=\"stylesheet\">

  <script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script>

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
    
    .btn-grd-primary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      color: white;
      padding: 12px 24px;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    
    .btn-grd-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
      color: white;
    }
    
    .btn-filter {
      background: white;
      border: 2px solid #e0e0e0;
      color: #333;
      padding: 12px 24px;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    
    .btn-filter:hover {
      border-color: #667eea;
      background: #f8f9fa;
      transform: translateY(-1px);
    }
    
    .separator {
      display: flex;
      align-items: center;
      margin: 30px 0;
      color: #666;
    }
    
    .separator .line {
      flex: 1;
      height: 1px;
      background: #e0e0e0;
    }
    
    .separator p {
      padding: 0 15px;
      margin: 0;
      font-size: 14px;
    }
    
    .bg-grd-primary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
      border-color: #667eea;
      box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
    }
    
    .input-group-text {
      border: 2px solid #e0e0e0;
      border-left: none;
      background: transparent;
      color: #666;
    }
    
    .form-control.border-end-0 {
      border-right: none;
    }
  </style>
  
  <script src=\"https://code.jquery.com/jquery-3.6.4.min.js\"></script>
</head>
  
<body>
  <!--authentication-->
  <div class=\"mx-3 mx-lg-0\">
    <div class=\"card my-5 col-xl-9 col-xxl-8 mx-auto rounded-4 overflow-hidden p-4\">
      <div class=\"row g-4\">
        <div class=\"col-lg-6 d-flex\">
          <div class=\"card-body\">
            <img src=\"{{ asset('Back_Office/assets/images/logo-icon.png') }}\" class=\"mb-4\" width=\"145\" alt=\"PIDEV Education\">
            <h4 class=\"fw-bold\">Get Started Now</h4>
            <p class=\"mb-0\">Enter your credentials to login your account</p>
            
            <div class=\"row gy-2 gx-0 my-4\">
              <div class=\"col-12 col-lg-12\">
                <a href=\"{{ path('connect_google') }}\" class=\"btn btn-filter py-2 px-4 font-text1 fw-bold d-flex align-items-center justify-content-center w-100 text-decoration-none\">
                  <span class=\"\"><i class=\"fab fa-google me-2\"></i>Sign in with Google</span>
                </a>
              </div>
              <div class=\"col-12 col-lg-12\">
                <button class=\"btn btn-filter py-2 px-4 font-text1 fw-bold d-flex align-items-center justify-content-center w-100\">
                  <span class=\"\"><i class=\"fab fa-facebook-f me-2\"></i>Sign in with Facebook</span>
                </button>
              </div>
              <div class=\"col-12 col-lg-12\">
                <button class=\"btn btn-filter py-2 px-4 font-text1 fw-bold d-flex align-items-center justify-content-center w-100\">
                  <span class=\"\"><i class=\"fab fa-linkedin-in me-2\"></i>Sign in with LinkedIn</span>
                </button>
              </div>
            </div>

            <div class=\"separator\">
              <div class=\"line\"></div>
              <p class=\"mb-0 fw-bold\">OR SIGN IN WITH</p>
              <div class=\"line\"></div>
            </div>
            
            <div class=\"form-body mt-4\">
              <form method=\"post\" action=\"{{ path('app_login') }}\" novalidate=\"novalidate\" class=\"row g-3\">
                {% if error %}
                  <div class=\"col-12\">
                    <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                      {{ error.messageKey|trans(error.messageData, 'security') }}
                      <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
                    </div>
                  </div>
                {% endif %}
                
                {% if not app.user %}
                  {% for type, messages in app.session.flashbag.all() %}
                    {% for message in messages %}
                      <div class=\"col-12\">
                        <div class=\"alert alert-{{ type }} alert-dismissible fade show\" role=\"alert\">
                          {{ message }}
                          <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
                        </div>
                      </div>
                    {% endfor %}
                  {% endfor %}
                {% endif %}
                
                {% if app.user %}
                  <div class=\"col-12\">
                    <div class=\"alert alert-info\">
                      You are logged in as {{ app.user.email }}, <a href=\"{{ path('app_logout') }}\">Logout</a>
                    </div>
                  </div>
                {% endif %}
                
                <div class=\"col-12\">
                  <label for=\"inputEmailAddress\" class=\"form-label\">Email</label>
                  <input type=\"email\" class=\"form-control\" id=\"inputEmailAddress\" name=\"_username\" 
                         value=\"{{ last_username }}\" placeholder=\"jhon@example.com\" autofocus>
                </div>
                
                <div class=\"col-12\">
                  <label for=\"inputChoosePassword\" class=\"form-label\">Password</label>
                  <div class=\"input-group\" id=\"show_hide_password\">
                    <input type=\"password\" class=\"form-control border-end-0\" id=\"inputChoosePassword\" 
                           name=\"_password\" placeholder=\"Enter Password\">
                    <a href=\"javascript:;\" class=\"input-group-text bg-transparent\">
                      <i class=\"bi bi-eye-slash-fill\"></i>
                    </a>
                  </div>
                </div>
                
                <div class=\"col-md-6\">
                  <div class=\"form-check form-switch\">
                    <input class=\"form-check-input\" type=\"checkbox\" id=\"flexSwitchCheckChecked\" name=\"_remember_me\">
                    <label class=\"form-check-label\" for=\"flexSwitchCheckChecked\">Remember Me</label>
                  </div>
                </div>
                
                <div class=\"col-md-6 text-end\">
                  <a href=\"{{ path('app_forgot_password') }}\" class=\"text-decoration-none\">Forgot Password ?</a>
                  <br>
                  <small class=\"text-muted\">
                    <a href=\"https://accounts.google.com/Logout\" target=\"_blank\" class=\"text-decoration-none\">Logout from Google</a>
                  </small>
                </div>
                
                <input type=\"hidden\" name=\"_csrf_token\" value=\"{{ csrf_token('authenticate') }}\">
                
                <div class=\"col-12\">
                  <div class=\"d-grid\">
                    <button type=\"submit\" class=\"btn btn-grd-primary\">Login</button>
                  </div>
                </div>
                
                <div class=\"col-12\">
                  <div class=\"text-start\">
                    <p class=\"mb-0\">Don't have an account yet? <a href=\"{{ path('app_register') }}\" class=\"text-decoration-none\">Sign up here</a></p>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        
        <div class=\"col-lg-6 d-lg-flex d-none\">
          <div class=\"p-3 rounded-4 w-100 d-flex align-items-center justify-content-center bg-grd-primary\">
            <img src=\"{{ asset('Back_Office/assets/images/auth/login1.png') }}\" class=\"img-fluid\" alt=\"Login Illustration\">
          </div>
        </div>
      </div><!--end row-->
    </div>
  </div>
  <!--authentication-->

  <!-- Bootstrap JS -->
  <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js\"></script>
  
  <script>
   \$(document).ready(function () {
     // Clear the password field on page load
     \$('#inputChoosePassword').val('');

     // Toggle password show/hide
     \$(\"#show_hide_password a\").on('click', function (event) {
       event.preventDefault();
       const input = \$('#show_hide_password input');
       const icon = \$('#show_hide_password i');
       if (input.attr(\"type\") === \"text\") {
         input.attr('type', 'password');
         icon.addClass(\"bi-eye-slash-fill\").removeClass(\"bi-eye-fill\");
       } else {
         input.attr('type', 'text');
         icon.removeClass(\"bi-eye-slash-fill\").addClass(\"bi-eye-fill\");
       }
     });

     // Validation functions
     function validateEmail(email) {
       const re = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+\$/;
       return re.test(email);
     }

     function showError(input, message) {
       const \$input = \$(input);
       \$input.addClass('is-invalid');
       \$input.removeClass('shake');
       void \$input[0].offsetWidth; // force reflow
       \$input.addClass('shake');

       if (!\$input.next('.invalid-feedback').length) {
         \$input.after(`<div class=\"invalid-feedback\">\${message}</div>`);
       } else {
         \$input.next('.invalid-feedback').text(message);
       }
     }

     function clearError(input) {
       const \$input = \$(input);
       \$input.removeClass('is-invalid shake');
       \$input.next('.invalid-feedback').remove();
     }

     // Live validation on typing for Email
     \$('#inputEmailAddress').on('input', function () {
       const email = \$(this).val().trim();
       if (email === '') {
         clearError(this);
       } else if (!email.includes('@')) {
         showError(this, \"Missing @ symbol.\");
       } else if (email.indexOf('@') !== email.lastIndexOf('@')) {
         showError(this, \"Only one @ symbol is allowed.\");
       } else if (email.split('@')[1].length < 1) {
         showError(this, \"Missing characters after @.\");
       } else if (email.split('@')[1] && !email.split('@')[1].includes('.')) {
         showError(this, \"Missing domain extension (e.g., .com).\");
       } else if (!validateEmail(email)) {
         showError(this, \"Enter a valid email.\");
       } else {
         clearError(this);
       }
     });

     // Live validation on typing for Password
     \$('#inputChoosePassword').on('input', function () {
       const password = \$(this).val().trim();
       if (password === '') {
         clearError(this);
       } else if (password.length < 6) {
         showError(this, \"Minimum 6 characters.\");
       } else {
         clearError(this);
       }
     });

     // Initial validation on page load (no errors should be shown)
     \$('#inputEmailAddress').trigger('input');
     \$('#inputChoosePassword').trigger('input');
   });
  </script>
</body>
</html>
", "security/login.html.twig", "C:\\Users\\LordKiller\\Downloads\\user\\templates\\security\\login.html.twig");
    }
}
