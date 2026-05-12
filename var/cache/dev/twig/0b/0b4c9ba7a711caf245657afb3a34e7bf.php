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

/* security/forgot_password.html.twig */
class __TwigTemplate_0f233ad664ec9cf15cff110e3375108a extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "security/forgot_password.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "security/forgot_password.html.twig"));

        // line 1
        yield "<!doctype html>
<html lang=\"en\" data-bs-theme=\"blue-theme\">

<head>
  <meta charset=\"utf-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
  <title>PIDEV Education - Forgot Password</title>
  
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
    
    .btn-grd-warning {
      background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
      border: none;
      color: white;
      padding: 12px 24px;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    
    .btn-grd-warning:hover {
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
    
    .bg-grd-warning {
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

    .code-input {
      letter-spacing: 8px;
      font-size: 24px;
      text-align: center;
      font-weight: bold;
      font-family: 'Courier New', monospace;
    }

    .fade-in {
      animation: fadeIn 0.5s ease-in;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .loading {
      opacity: 0.6;
      pointer-events: none;
    }

    .alert {
      border-radius: 8px;
      border: none;
    }

    .step-indicator {
      display: flex;
      justify-content: center;
      margin-bottom: 30px;
    }

    .step {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: #e0e0e0;
      color: #666;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      margin: 0 10px;
      transition: all 0.3s ease;
    }

    .step.active {
      background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
      color: white;
    }

    .step.completed {
      background: #28a745;
      color: white;
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
        // line 186
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/images/logo1.png"), "html", null, true);
        yield "\" class=\"mb-4\" width=\"145\" alt=\"\">
          
          <!-- Step Indicator -->
          <div class=\"step-indicator\">
            <div class=\"step active\" id=\"step1\">1</div>
            <div class=\"step\" id=\"step2\">2</div>
            <div class=\"step\" id=\"step3\">3</div>
          </div>

          <!-- Step 1: Email Input -->
          <div id=\"emailStep\" class=\"fade-in\">
            <h4 class=\"fw-bold\">Forgot Password?</h4>
            <p class=\"mb-0\">Enter your registered email ID to reset password</p>
          </div>

          <!-- Step 2: Code Verification -->
          <div id=\"codeStep\" style=\"display: none;\" class=\"fade-in\">
            <h4 class=\"fw-bold\">Enter Verification Code</h4>
            <p class=\"mb-0\">We've sent a 6-digit code to your email. Enter it below to continue.</p>
          </div>

          <!-- Alert Container -->
          <div id=\"alertContainer\"></div>

          <div class=\"form-body mt-4\">
            <!-- Email Form -->
            <form id=\"emailForm\" class=\"row g-3\">
              <div class=\"col-12\">
                <label class=\"form-label\">Email id</label>
                <input type=\"text\" name=\"email\" id=\"emailInput\" class=\"form-control\" placeholder=\"example@user.com\" required>
              </div>
              <div class=\"col-12\">
                <div class=\"d-grid gap-2\">
                  <button type=\"submit\" class=\"btn btn-grd-warning\" id=\"sendBtn\">Send</button>
                   <a href=\"";
        // line 220
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
        yield "\" class=\"btn btn-light\">Back to Login</a>
                </div>
              </div>
            </form>

            <!-- Code Form -->
            <form id=\"codeForm\" style=\"display: none;\" class=\"row g-3\">
              <input type=\"hidden\" name=\"email\" id=\"hiddenEmail\">
              <div class=\"col-12\">
                <label class=\"form-label\">Verification Code</label>
                <input type=\"text\" name=\"code\" id=\"codeInput\" class=\"form-control code-input\" placeholder=\"000000\" maxlength=\"6\" required>
              </div>
              <div class=\"col-12\">
                <div class=\"d-grid gap-2\">
                  <button type=\"submit\" class=\"btn btn-grd-warning\" id=\"verifyBtn\">Verify Code</button>
                  <button type=\"button\" class=\"btn btn-light\" id=\"backBtn\">Back</button>
                </div>
              </div>
            </form>
          </div>

      </div>
      </div>
      <div class=\"col-lg-6 d-lg-flex d-none\">
        <div class=\"p-3 rounded-4 w-100 d-flex align-items-center justify-content-center bg-grd-warning\">
          <img src=\"";
        // line 245
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/images/auth/forgot-password1.png"), "html", null, true);
        yield "\" class=\"img-fluid\" alt=\"\">
        </div>
      </div>

    </div><!--end row-->
  </div>

</div>

  <!--authentication-->

  <!--plugins-->
  <script src=\"";
        // line 257
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back_Office/assets/js/jquery.min.js"), "html", null, true);
        yield "\"></script>

  <script>
    \$(document).ready(function () {
      let currentStep = 1;
      let userEmail = '';

      // Show alert function
      function showAlert(message, type) {
        const alertClass = type === 'error' ? 'alert-danger' : 'alert-success';
        const alertHtml = `
          <div class=\"alert \${alertClass}\" role=\"alert\">
            \${message}
          </div>
        `;
        \$('#alertContainer').html(alertHtml);
        
        // Auto-hide success alerts after 5 seconds
        if (type === 'success') {
          setTimeout(() => {
            \$('#alertContainer').html('');
          }, 5000);
        }
      }

      // Update step indicator
      function updateStepIndicator(step) {
        \$('.step').removeClass('active completed');
        for (let i = 1; i <= step; i++) {
          if (i < step) {
            \$(`#step\${i}`).addClass('completed');
          } else {
            \$(`#step\${i}`).addClass('active');
          }
        }
      }

      // Switch between steps
      function switchToStep(step) {
        currentStep = step;
        updateStepIndicator(step);
        
        if (step === 1) {
          \$('#emailStep').show().addClass('fade-in');
          \$('#codeStep').hide();
          \$('#emailForm').show();
          \$('#codeForm').hide();
        } else if (step === 2) {
          \$('#emailStep').hide();
          \$('#codeStep').show().addClass('fade-in');
          \$('#emailForm').hide();
          \$('#codeForm').show();
        }
      }

      // Email form submission
      \$('#emailForm').on('submit', function(e) {
        e.preventDefault();
        
        const email = \$('#emailInput').val().trim();
        
        // Clear previous errors
        \$('.is-invalid').removeClass('is-invalid');
        \$('.invalid-feedback').remove();
        \$('#alertContainer').html('');
        
        // Validate email
        if (!email) {
          \$('#emailInput').addClass('is-invalid shake');
          \$('#emailInput').after('<div class=\"invalid-feedback\">Email is required</div>');
          return false;
        }
        
        var emailRegex = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+\$/;
        if (!emailRegex.test(email)) {
          \$('#emailInput').addClass('is-invalid shake');
          \$('#emailInput').after('<div class=\"invalid-feedback\">Please enter a valid email address</div>');
          return false;
        }

        // Show loading state
        \$('#sendBtn').prop('disabled', true).text('Sending...');
        \$('#emailForm').addClass('loading');

        // Send AJAX request
        \$.ajax({
          url: '";
        // line 343
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_forgot_password");
        yield "',
          method: 'POST',
          data: {
            action: 'send_code',
            email: email
          },
          success: function(response) {
            \$('#sendBtn').prop('disabled', false).text('Send');
            \$('#emailForm').removeClass('loading');
            
            if (response.success) {
              userEmail = email;
              \$('#hiddenEmail').val(email);
              showAlert(response.success, 'success');
              
              // Switch to code verification step
              setTimeout(() => {
                switchToStep(2);
                \$('#codeInput').focus();
              }, 1500);
            } else if (response.error) {
              showAlert(response.error, 'error');
            }
          },
          error: function(xhr) {
            \$('#sendBtn').prop('disabled', false).text('Send');
            \$('#emailForm').removeClass('loading');
            
            const response = xhr.responseJSON || {};
            showAlert(response.error || 'An error occurred. Please try again.', 'error');
          }
        });
      });

      // Code form submission
      \$('#codeForm').on('submit', function(e) {
        e.preventDefault();
        
        const code = \$('#codeInput').val().trim();
        
        // Clear previous errors
        \$('.is-invalid').removeClass('is-invalid');
        \$('.invalid-feedback').remove();
        \$('#alertContainer').html('');
        
        // Validate code
        if (!code) {
          \$('#codeInput').addClass('is-invalid shake');
          \$('#codeInput').after('<div class=\"invalid-feedback\">Verification code is required</div>');
          return false;
        }
        
        if (code.length !== 6 || !/^\\d{6}\$/.test(code)) {
          \$('#codeInput').addClass('is-invalid shake');
          \$('#codeInput').after('<div class=\"invalid-feedback\">Please enter a valid 6-digit code</div>');
          return false;
        }

        // Show loading state
        \$('#verifyBtn').prop('disabled', true).text('Verifying...');
        \$('#codeForm').addClass('loading');

        // Send AJAX request
        \$.ajax({
          url: '";
        // line 407
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_forgot_password");
        yield "',
          method: 'POST',
          data: {
            action: 'verify_code',
            email: userEmail,
            code: code
          },
          success: function(response) {
            \$('#verifyBtn').prop('disabled', false).text('Verify Code');
            \$('#codeForm').removeClass('loading');
            
            if (response.success) {
              showAlert(response.success, 'success');
              
              // Redirect to reset password page
              setTimeout(() => {
                window.location.href = response.redirect;
              }, 1500);
            } else if (response.error) {
              showAlert(response.error, 'error');
            }
          },
          error: function(xhr) {
            \$('#verifyBtn').prop('disabled', false).text('Verify Code');
            \$('#codeForm').removeClass('loading');
            
            const response = xhr.responseJSON || {};
            showAlert(response.error || 'An error occurred. Please try again.', 'error');
          }
        });
      });

      // Back button
      \$('#backBtn').on('click', function() {
        switchToStep(1);
        \$('#codeInput').val('');
        \$('#alertContainer').html('');
      });

      // Remove error on input
      \$('#emailInput').on('input', function() {
        \$(this).removeClass('is-invalid shake');
        \$(this).next('.invalid-feedback').remove();
      });

      \$('#codeInput').on('input', function() {
        \$(this).removeClass('is-invalid shake');
        \$(this).next('.invalid-feedback').remove();
        
        // Auto-format: only allow numbers, max 6 digits
        let value = \$(this).val().replace(/\\D/g, '').slice(0, 6);
        \$(this).val(value);
      });

      // Auto-focus next input on paste (if user pastes 6-digit code)
      \$('#codeInput').on('paste', function(e) {
        setTimeout(() => {
          const value = \$(this).val().replace(/\\D/g, '').slice(0, 6);
          \$(this).val(value);
          
          if (value.length === 6) {
            \$('#codeForm').submit();
          }
        }, 10);
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
        return "security/forgot_password.html.twig";
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
        return array (  507 => 407,  440 => 343,  351 => 257,  336 => 245,  308 => 220,  271 => 186,  110 => 28,  106 => 27,  102 => 26,  98 => 25,  94 => 24,  87 => 20,  82 => 18,  78 => 17,  74 => 16,  68 => 13,  64 => 12,  59 => 10,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!doctype html>
<html lang=\"en\" data-bs-theme=\"blue-theme\">

<head>
  <meta charset=\"utf-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
  <title>PIDEV Education - Forgot Password</title>
  
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
    
    .btn-grd-warning {
      background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
      border: none;
      color: white;
      padding: 12px 24px;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    
    .btn-grd-warning:hover {
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
    
    .bg-grd-warning {
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

    .code-input {
      letter-spacing: 8px;
      font-size: 24px;
      text-align: center;
      font-weight: bold;
      font-family: 'Courier New', monospace;
    }

    .fade-in {
      animation: fadeIn 0.5s ease-in;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .loading {
      opacity: 0.6;
      pointer-events: none;
    }

    .alert {
      border-radius: 8px;
      border: none;
    }

    .step-indicator {
      display: flex;
      justify-content: center;
      margin-bottom: 30px;
    }

    .step {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: #e0e0e0;
      color: #666;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      margin: 0 10px;
      transition: all 0.3s ease;
    }

    .step.active {
      background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
      color: white;
    }

    .step.completed {
      background: #28a745;
      color: white;
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
          
          <!-- Step Indicator -->
          <div class=\"step-indicator\">
            <div class=\"step active\" id=\"step1\">1</div>
            <div class=\"step\" id=\"step2\">2</div>
            <div class=\"step\" id=\"step3\">3</div>
          </div>

          <!-- Step 1: Email Input -->
          <div id=\"emailStep\" class=\"fade-in\">
            <h4 class=\"fw-bold\">Forgot Password?</h4>
            <p class=\"mb-0\">Enter your registered email ID to reset password</p>
          </div>

          <!-- Step 2: Code Verification -->
          <div id=\"codeStep\" style=\"display: none;\" class=\"fade-in\">
            <h4 class=\"fw-bold\">Enter Verification Code</h4>
            <p class=\"mb-0\">We've sent a 6-digit code to your email. Enter it below to continue.</p>
          </div>

          <!-- Alert Container -->
          <div id=\"alertContainer\"></div>

          <div class=\"form-body mt-4\">
            <!-- Email Form -->
            <form id=\"emailForm\" class=\"row g-3\">
              <div class=\"col-12\">
                <label class=\"form-label\">Email id</label>
                <input type=\"text\" name=\"email\" id=\"emailInput\" class=\"form-control\" placeholder=\"example@user.com\" required>
              </div>
              <div class=\"col-12\">
                <div class=\"d-grid gap-2\">
                  <button type=\"submit\" class=\"btn btn-grd-warning\" id=\"sendBtn\">Send</button>
                   <a href=\"{{ path('app_login') }}\" class=\"btn btn-light\">Back to Login</a>
                </div>
              </div>
            </form>

            <!-- Code Form -->
            <form id=\"codeForm\" style=\"display: none;\" class=\"row g-3\">
              <input type=\"hidden\" name=\"email\" id=\"hiddenEmail\">
              <div class=\"col-12\">
                <label class=\"form-label\">Verification Code</label>
                <input type=\"text\" name=\"code\" id=\"codeInput\" class=\"form-control code-input\" placeholder=\"000000\" maxlength=\"6\" required>
              </div>
              <div class=\"col-12\">
                <div class=\"d-grid gap-2\">
                  <button type=\"submit\" class=\"btn btn-grd-warning\" id=\"verifyBtn\">Verify Code</button>
                  <button type=\"button\" class=\"btn btn-light\" id=\"backBtn\">Back</button>
                </div>
              </div>
            </form>
          </div>

      </div>
      </div>
      <div class=\"col-lg-6 d-lg-flex d-none\">
        <div class=\"p-3 rounded-4 w-100 d-flex align-items-center justify-content-center bg-grd-warning\">
          <img src=\"{{ asset('Back_Office/assets/images/auth/forgot-password1.png') }}\" class=\"img-fluid\" alt=\"\">
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
      let currentStep = 1;
      let userEmail = '';

      // Show alert function
      function showAlert(message, type) {
        const alertClass = type === 'error' ? 'alert-danger' : 'alert-success';
        const alertHtml = `
          <div class=\"alert \${alertClass}\" role=\"alert\">
            \${message}
          </div>
        `;
        \$('#alertContainer').html(alertHtml);
        
        // Auto-hide success alerts after 5 seconds
        if (type === 'success') {
          setTimeout(() => {
            \$('#alertContainer').html('');
          }, 5000);
        }
      }

      // Update step indicator
      function updateStepIndicator(step) {
        \$('.step').removeClass('active completed');
        for (let i = 1; i <= step; i++) {
          if (i < step) {
            \$(`#step\${i}`).addClass('completed');
          } else {
            \$(`#step\${i}`).addClass('active');
          }
        }
      }

      // Switch between steps
      function switchToStep(step) {
        currentStep = step;
        updateStepIndicator(step);
        
        if (step === 1) {
          \$('#emailStep').show().addClass('fade-in');
          \$('#codeStep').hide();
          \$('#emailForm').show();
          \$('#codeForm').hide();
        } else if (step === 2) {
          \$('#emailStep').hide();
          \$('#codeStep').show().addClass('fade-in');
          \$('#emailForm').hide();
          \$('#codeForm').show();
        }
      }

      // Email form submission
      \$('#emailForm').on('submit', function(e) {
        e.preventDefault();
        
        const email = \$('#emailInput').val().trim();
        
        // Clear previous errors
        \$('.is-invalid').removeClass('is-invalid');
        \$('.invalid-feedback').remove();
        \$('#alertContainer').html('');
        
        // Validate email
        if (!email) {
          \$('#emailInput').addClass('is-invalid shake');
          \$('#emailInput').after('<div class=\"invalid-feedback\">Email is required</div>');
          return false;
        }
        
        var emailRegex = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+\$/;
        if (!emailRegex.test(email)) {
          \$('#emailInput').addClass('is-invalid shake');
          \$('#emailInput').after('<div class=\"invalid-feedback\">Please enter a valid email address</div>');
          return false;
        }

        // Show loading state
        \$('#sendBtn').prop('disabled', true).text('Sending...');
        \$('#emailForm').addClass('loading');

        // Send AJAX request
        \$.ajax({
          url: '{{ path(\"app_forgot_password\") }}',
          method: 'POST',
          data: {
            action: 'send_code',
            email: email
          },
          success: function(response) {
            \$('#sendBtn').prop('disabled', false).text('Send');
            \$('#emailForm').removeClass('loading');
            
            if (response.success) {
              userEmail = email;
              \$('#hiddenEmail').val(email);
              showAlert(response.success, 'success');
              
              // Switch to code verification step
              setTimeout(() => {
                switchToStep(2);
                \$('#codeInput').focus();
              }, 1500);
            } else if (response.error) {
              showAlert(response.error, 'error');
            }
          },
          error: function(xhr) {
            \$('#sendBtn').prop('disabled', false).text('Send');
            \$('#emailForm').removeClass('loading');
            
            const response = xhr.responseJSON || {};
            showAlert(response.error || 'An error occurred. Please try again.', 'error');
          }
        });
      });

      // Code form submission
      \$('#codeForm').on('submit', function(e) {
        e.preventDefault();
        
        const code = \$('#codeInput').val().trim();
        
        // Clear previous errors
        \$('.is-invalid').removeClass('is-invalid');
        \$('.invalid-feedback').remove();
        \$('#alertContainer').html('');
        
        // Validate code
        if (!code) {
          \$('#codeInput').addClass('is-invalid shake');
          \$('#codeInput').after('<div class=\"invalid-feedback\">Verification code is required</div>');
          return false;
        }
        
        if (code.length !== 6 || !/^\\d{6}\$/.test(code)) {
          \$('#codeInput').addClass('is-invalid shake');
          \$('#codeInput').after('<div class=\"invalid-feedback\">Please enter a valid 6-digit code</div>');
          return false;
        }

        // Show loading state
        \$('#verifyBtn').prop('disabled', true).text('Verifying...');
        \$('#codeForm').addClass('loading');

        // Send AJAX request
        \$.ajax({
          url: '{{ path(\"app_forgot_password\") }}',
          method: 'POST',
          data: {
            action: 'verify_code',
            email: userEmail,
            code: code
          },
          success: function(response) {
            \$('#verifyBtn').prop('disabled', false).text('Verify Code');
            \$('#codeForm').removeClass('loading');
            
            if (response.success) {
              showAlert(response.success, 'success');
              
              // Redirect to reset password page
              setTimeout(() => {
                window.location.href = response.redirect;
              }, 1500);
            } else if (response.error) {
              showAlert(response.error, 'error');
            }
          },
          error: function(xhr) {
            \$('#verifyBtn').prop('disabled', false).text('Verify Code');
            \$('#codeForm').removeClass('loading');
            
            const response = xhr.responseJSON || {};
            showAlert(response.error || 'An error occurred. Please try again.', 'error');
          }
        });
      });

      // Back button
      \$('#backBtn').on('click', function() {
        switchToStep(1);
        \$('#codeInput').val('');
        \$('#alertContainer').html('');
      });

      // Remove error on input
      \$('#emailInput').on('input', function() {
        \$(this).removeClass('is-invalid shake');
        \$(this).next('.invalid-feedback').remove();
      });

      \$('#codeInput').on('input', function() {
        \$(this).removeClass('is-invalid shake');
        \$(this).next('.invalid-feedback').remove();
        
        // Auto-format: only allow numbers, max 6 digits
        let value = \$(this).val().replace(/\\D/g, '').slice(0, 6);
        \$(this).val(value);
      });

      // Auto-focus next input on paste (if user pastes 6-digit code)
      \$('#codeInput').on('paste', function(e) {
        setTimeout(() => {
          const value = \$(this).val().replace(/\\D/g, '').slice(0, 6);
          \$(this).val(value);
          
          if (value.length === 6) {
            \$('#codeForm').submit();
          }
        }, 10);
      });
    });
  </script>

</body>
</html>
", "security/forgot_password.html.twig", "C:\\Users\\LordKiller\\Downloads\\user\\templates\\security\\forgot_password.html.twig");
    }
}
