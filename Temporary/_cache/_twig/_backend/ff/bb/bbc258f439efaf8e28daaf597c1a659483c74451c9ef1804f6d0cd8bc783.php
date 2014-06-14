<?php

/* writers/main.html */
class __TwigTemplate_ffbbbbc258f439efaf8e28daaf597c1a659483c74451c9ef1804f6d0cd8bc783 extends Twig_Template
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
\t\t<div class=\"col-lg-6 col-lg-offset-1\">
\t\t\t<div class=\"panel panel-primary\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t<h3 class=\"panel-title\">Update or Add Writer</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t<div id=\"writers_select_container\" class=\"input_container\">
\t\t\t\t\t\t";
        // line 13
        $this->env->loadTemplate("writers/writers_select.html")->display($context);
        // line 14
        echo "\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t";
        // line 16
        echo (isset($context["WRITER_FORM"]) ? $context["WRITER_FORM"] : null);
        echo "
\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t<div class=\"button_panel\">
\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-success\" value=\"SAVE\" name=\"submitBtn\" id=\"submitBtn\">
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-info\" value=\"RESET\" name=\"resetBtn\" id=\"resetBtn\">
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-lg-4\">
\t\t\t<div class=\"panel panel-primary\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t<h3 class=\"panel-title\">Opt Ins</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t<div id=\"opt-in-list\" class=\"list-group\">
\t\t\t\t\t\t";
        // line 36
        $this->env->loadTemplate("writers/list-group-item.html")->display($context);
        // line 37
        echo "\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "writers/main.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 37,  71 => 36,  48 => 16,  44 => 14,  42 => 13,  31 => 4,  28 => 3,);
    }
}