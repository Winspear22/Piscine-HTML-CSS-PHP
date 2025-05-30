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

/* error404.html.twig */
class __TwigTemplate_fa7e6f3bed001542bfe39387f810d6cc extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "error404.html.twig"));

        // line 2
        yield "<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <title>Erreur 404 - Page non trouvée</title>
    <style>
        body {
            background: #f7f7f7;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            margin: 8% auto 0 auto;
            padding: 40px 30px;
            max-width: 460px;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 6px 40px #0001;
            text-align: center;
        }
        h1 {
            font-size: 4em;
            margin: 0;
            color: #cd002c;
        }
        h2 {
            font-size: 2em;
            margin-bottom: 10px;
            color: #444;
        }
        p {
            color: #666;
            margin-bottom: 30px;
        }
        a {
            display: inline-block;
            margin: 6px 8px;
            padding: 10px 24px;
            background: #cd002c;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.2s;
        }
        a:hover {
            background: #af0022;
        }
    </style>
</head>
<body>
    <div class=\"container\">
        <h1>404</h1>
        <h2>Page non trouvée</h2>
        <p>La page que vous cherchez n’existe pas ou a été déplacée.</p>
        <a href=\"";
        // line 57
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("ex03bundle_index");
        yield "\">Page principale Ex03</a>
        <a href=\"";
        // line 58
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("ex03bundle_insert");
        yield "\">Ajouter un utilisateur</a>
        <a href=\"";
        // line 59
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("ex03bundle_select");
        yield "\">Voir la liste des utilisateurs</a>
    </div>
</body>
</html>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "error404.html.twig";
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
        return array (  110 => 59,  106 => 58,  102 => 57,  45 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# templates/bundles/TwigBundle/Exception/error404.html.twig #}
<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <title>Erreur 404 - Page non trouvée</title>
    <style>
        body {
            background: #f7f7f7;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            margin: 8% auto 0 auto;
            padding: 40px 30px;
            max-width: 460px;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 6px 40px #0001;
            text-align: center;
        }
        h1 {
            font-size: 4em;
            margin: 0;
            color: #cd002c;
        }
        h2 {
            font-size: 2em;
            margin-bottom: 10px;
            color: #444;
        }
        p {
            color: #666;
            margin-bottom: 30px;
        }
        a {
            display: inline-block;
            margin: 6px 8px;
            padding: 10px 24px;
            background: #cd002c;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.2s;
        }
        a:hover {
            background: #af0022;
        }
    </style>
</head>
<body>
    <div class=\"container\">
        <h1>404</h1>
        <h2>Page non trouvée</h2>
        <p>La page que vous cherchez n’existe pas ou a été déplacée.</p>
        <a href=\"{{ path('ex03bundle_index') }}\">Page principale Ex03</a>
        <a href=\"{{ path('ex03bundle_insert') }}\">Ajouter un utilisateur</a>
        <a href=\"{{ path('ex03bundle_select') }}\">Voir la liste des utilisateurs</a>
    </div>
</body>
</html>
", "error404.html.twig", "/home/adnen/Desktop/06-05-2025/Day-05-restart/ex03/templates/error404.html.twig");
    }
}
