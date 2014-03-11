<?php

/* clients/main.html */
class __TwigTemplate_31c33eec05ffed830dc49684cceb9d5415f12ee809ba81b51e2e4bec435c846f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("_common/base.html");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "_common/base.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "<div class=\"container\">
\t<div class=\"row\">
\t\t<div class=\"col-lg-4 col-lg-offset-4\">
\t\t\t<div class=\"panel panel-primary\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t<h3 class=\"panel-title\">Update or Add Client</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t<div id=\"clients_select_container\">
\t\t\t\t\t\t";
        // line 13
        $this->env->loadTemplate("clients/clients_select.html")->display($context);
        // line 14
        echo "\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t";
        // line 16
        echo (isset($context["CLIENT_FORM"]) ? $context["CLIENT_FORM"] : null);
        echo "
\t\t\t\t\t<div class=\"button_panel\">
\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-success\" value=\"SAVE\" name=\"submitBtn\" id=\"submitBtn\">
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-danger\" value=\"DELETE\" name=\"deleteBtn\" id=\"deleteBtn\">
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-info\" value=\"RESET\" name=\"resetBtn\" id=\"resetBtn\">
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "clients/main.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  48 => 16,  44 => 14,  42 => 13,  31 => 4,  28 => 3,);
    }
}
