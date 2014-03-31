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
\t<div class=\"row\">
\t\t<div class=\"col-lg-6 col-lg-offset-1\">
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
\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t<div id=\"clients_select_container\" class=\"input_container\">
\t\t\t\t\t\t";
        // line 17
        $this->env->loadTemplate("invoices/clients_select.html")->display($context);
        // line 18
        echo "\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"clear\"><hr></div>
\t\t\t\t\t";
        // line 20
        echo (isset($context["INVOICE_FORM"]) ? $context["INVOICE_FORM"] : null);
        echo "
\t\t\t\t\t<div id=\"invoice_history_container\" class=\"input_container\">
\t\t\t\t\t\t<label for=\"invoice_history\">Invoice Status Entry</label><br>
\t\t\t\t\t\t<textarea class=\"form-control\" name=\"description\" id=\"description\"></textarea>
\t\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t\t<div style=\"margin-left:-10px;\" class=\"button_panel\">
\t\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-success\" value=\"UPDATE STATUS\" name=\"updateBtn\" id=\"updateBtn\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"clear\"><hr></div>
\t\t\t\t\t<div class=\"button_panel\" style=\"margin-left: 140px;\">
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
\t\t<div class=\"col-lg-4\">
\t\t\t<div class=\"panel panel-primary\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t<h3 class=\"panel-title\">Invoice Status History</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t<div id=\"status-list\" class=\"list-group\">
\t\t\t\t\t\t";
        // line 53
        $this->env->loadTemplate("invoices/list-group-item.html")->display($context);
        // line 54
        echo "\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"clear\"><hr></div>
\t\t\t\t\t<div><label>Status Entry</label><div id=\"status-desc\"><p align=\"center\">Nothing to show</p></div></div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-lg-4\">
\t\t\t<div class=\"panel panel-primary\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t<h3 class=\"panel-title\">Upload Invoice File</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t";
        // line 66
        $this->env->loadTemplate("invoices/file_upload.html")->display($context);
        // line 67
        echo "\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
<script type=\"text/javascript\">
<!--
\tvar timestamp = '";
        // line 74
        echo (isset($context["TIMESTAMP"]) ? $context["TIMESTAMP"] : null);
        echo "';
\tvar token = '";
        // line 75
        echo (isset($context["UPLOAD_TOKEN"]) ? $context["UPLOAD_TOKEN"] : null);
        echo "';
//-->
</script>
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
        return array (  122 => 75,  118 => 74,  109 => 67,  107 => 66,  93 => 54,  91 => 53,  55 => 20,  51 => 18,  49 => 17,  44 => 14,  42 => 13,  31 => 4,  28 => 3,);
    }
}
