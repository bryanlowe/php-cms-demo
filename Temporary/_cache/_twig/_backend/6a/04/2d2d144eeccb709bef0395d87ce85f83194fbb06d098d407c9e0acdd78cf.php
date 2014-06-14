<?php

/* invoices/main.html */
class __TwigTemplate_6a042d2d144eeccb709bef0395d87ce85f83194fbb06d098d407c9e0acdd78cf extends Twig_Template
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
\t\t<div class=\"col-lg-10 col-lg-offset-1\">
\t\t\t<div class=\"panel panel-primary\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t<h3 class=\"panel-title\">Update or Add an Invoice</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t<div id=\"invoices_select_container\" class=\"input_container\">
\t\t\t\t\t\t";
        // line 13
        $this->env->loadTemplate("invoices/invoices_select.html")->display($context);
        // line 14
        echo "\t\t\t\t\t</div>
\t\t\t\t\t<div id=\"toggleInvoice\" class=\"button_panel input_container\">
\t\t\t\t\t\t";
        // line 16
        $this->env->loadTemplate("invoices/invoice_status.html")->display($context);
        // line 17
        echo "\t\t\t\t\t</div>
\t\t\t\t\t<div id=\"clients_select_container\" class=\"input_container\">
\t\t\t\t\t\t";
        // line 19
        $this->env->loadTemplate("invoices/clients_select.html")->display($context);
        // line 20
        echo "\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t<div id=\"projects_select_container\" class=\"input_container\">
\t\t\t\t\t\t";
        // line 23
        $this->env->loadTemplate("invoices/projects_select.html")->display($context);
        // line 24
        echo "\t\t\t\t\t</div>
\t\t\t\t\t<div id=\"addProjectBtn\" class=\"button_panel input_container\">
\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-success\" value=\"ADD PROJECT\" name=\"addBtn\" id=\"addBtn\">
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div id=\"current_projects\" class=\"list-group col-lg-5 col-lg-offset-1 input_container\">
\t\t\t\t\t\t";
        // line 31
        $this->env->loadTemplate("invoices/current_projects.html")->display($context);
        // line 32
        echo "\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"clear\"><hr></div>
\t\t\t\t\t";
        // line 34
        echo (isset($context["INVOICE_FORM"]) ? $context["INVOICE_FORM"] : null);
        echo "
\t\t\t\t\t<div class=\"clear\"><hr></div>
\t\t\t\t\t<div class=\"button_panel\" style=\"margin-left: 310px;\">
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
        return "invoices/main.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 34,  74 => 32,  72 => 31,  63 => 24,  61 => 23,  56 => 20,  54 => 19,  50 => 17,  48 => 16,  44 => 14,  42 => 13,  31 => 4,  28 => 3,);
    }
}
