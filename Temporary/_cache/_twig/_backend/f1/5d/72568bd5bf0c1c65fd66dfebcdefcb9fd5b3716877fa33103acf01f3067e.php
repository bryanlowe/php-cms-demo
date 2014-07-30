<?php

/* create-invoice/main.html */
class __TwigTemplate_f15d72568bd5bf0c1c65fd66dfebcdefcb9fd5b3716877fa33103acf01f3067e extends Twig_Template
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
\t\t<div class=\"col-lg-12\">
\t\t\t<div class=\"panel panel-primary\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t<h3 class=\"panel-title\">Create Writer Invoice</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t<div id=\"writers_select_container\" class=\"input_container\">
\t\t\t\t\t\t";
        // line 13
        $this->env->loadTemplate("create-invoice/writers_select.html")->display($context);
        // line 14
        echo "\t\t\t\t\t</div>
\t\t\t\t\t<div id=\"start_date_container\" class=\"input_container\">
\t\t\t\t\t\t<label for=\"start_date\">Start Date</label><br>
\t\t\t\t\t\t<input type=\"text\" class=\"form-control\" name=\"start_date\" id=\"start_date\" />
\t\t\t\t\t</div>
\t\t\t\t\t<div id=\"end_date_container\" class=\"input_container\">
\t\t\t\t\t\t<label for=\"end_date\">End Date</label><br>
\t\t\t\t\t\t<input type=\"text\" class=\"form-control\" name=\"end_date\" id=\"end_date\" />
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"button_panel\" style=\"margin-top: 26px;\">
\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-info\" value=\"CREATE INVOICE\" name=\"createBtn\" id=\"createBtn\">
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-success\" value=\"SAVE\" name=\"submitBtn\" id=\"submitBtn\">
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-info\" value=\"RESET\" name=\"resetBtn\" id=\"resetBtn\">
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"clear\"><hr></div>
\t\t\t\t\t<div id=\"writer-invoice\" class=\"table-responsive\">
\t                    ";
        // line 36
        $this->env->loadTemplate("create-invoice/invoice-entry.html")->display($context);
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
        return "create-invoice/main.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  70 => 37,  68 => 36,  44 => 14,  42 => 13,  31 => 4,  28 => 3,);
    }
}
