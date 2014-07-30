<?php

/* feedback/main.html */
class __TwigTemplate_4e5bfabb5c67ab94a0b4f086730f95f8a4b883046af5fdf42917633c440618b7 extends Twig_Template
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
\t<div class=\"row task-panel\">
\t\t<div class=\"col-lg-6 col-lg-offset-3\">
\t\t\t<div class=\"panel panel-primary\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t<h3 class=\"panel-title\">Let us know what you think!</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t<div id=\"projects_select_container\">
\t\t\t\t\t\t";
        // line 13
        $this->env->loadTemplate("feedback/projects_select.html")->display($context);
        // line 14
        echo "\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t<div id=\"anonymous_select_container\">
\t\t\t\t\t\t<label for=\"anonymous_select\">I prefer to be:</label><br>
\t\t\t\t\t\t<select class=\"form-control\" name=\"anonymous_select\" id=\"anonymous_select\">
\t\t\t\t\t\t\t<option value=\"1\">myself</option>
\t\t\t\t\t\t\t<option value=\"0\">anonymous</option>
\t\t\t\t\t\t</select>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t";
        // line 24
        echo (isset($context["FEEDBACK_FORM"]) ? $context["FEEDBACK_FORM"] : null);
        echo "
\t\t\t\t\t<div class=\"button_panel\">
\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-success\" value=\"SUBMIT FEEDBACK\" name=\"submitBtn\" id=\"submitBtn\">
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
        return "feedback/main.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 24,  44 => 14,  42 => 13,  31 => 4,  28 => 3,);
    }
}
