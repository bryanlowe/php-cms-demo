<?php

/* edit-invoice/main.html */
class __TwigTemplate_029c7e0d9c7db26aff6e9cad8b3e46b5e95eac566d23888ee8a45b3d3825d83b extends Twig_Template
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
\t\t\t\t\t<h3 class=\"panel-title\">Edit Writer Invoice</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t<div id=\"writers_select_container\" class=\"input_container\">
\t\t\t\t\t\t";
        // line 13
        $this->env->loadTemplate("edit-invoice/writers_select.html")->display($context);
        // line 14
        echo "\t\t\t\t\t</div>
\t\t\t\t\t<div id=\"toggle-invoice-type\" class=\"input_container\">
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t                <label>Toggle Invoice Type</label><br />
\t\t\t                <div class=\"radio-inline\">
\t\t\t                  <label>
\t\t\t                    <input type=\"radio\" value=\"OPEN\" checked=\"\" id=\"toggle_invoice_1\" name=\"toggle_invoice\">
\t\t\t                    Open
\t\t\t                  </label>
\t\t\t                </div>
\t\t\t               \t<div class=\"radio-inline\">
\t\t\t                  <label>
\t\t\t                    <input type=\"radio\" value=\"PAID\" id=\"toggle_invoice_2\" name=\"toggle_invoice\">
\t\t\t                    Paid
\t\t\t                  </label>
\t\t\t                </div>
\t\t\t            </div>
\t\t\t\t\t</div>
\t\t\t\t\t<div id=\"invoices_select_container\" class=\"input_container\">
\t\t\t\t\t\t";
        // line 33
        $this->env->loadTemplate("edit-invoice/invoices_select.html")->display($context);
        // line 34
        echo "\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"button_panel\" style=\"margin-top: 26px;\">
\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-info\" value=\"LOAD INVOICE\" name=\"loadBtn\" id=\"loadBtn\">
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"btn_container\" style=\"margin-top: -25px;\">
\t\t\t\t\t\t\t<label style=\"margin-left: 10px;\">Change Status</label><br />
\t\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-success\" value=\"PAID\" name=\"paidBtn\" id=\"paidBtn\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-danger\" value=\"OPEN\" name=\"openBtn\" id=\"openBtn\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-info\" value=\"RESET\" name=\"resetBtn\" id=\"resetBtn\">
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-danger\" value=\"DELETE\" name=\"deleteBtn\" id=\"deleteBtn\">
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"clear\"><hr></div>
\t\t\t\t\t<div id=\"writer-invoice\" class=\"table-responsive\">
\t                    ";
        // line 57
        $this->env->loadTemplate("create-invoice/invoice-entry.html")->display($context);
        // line 58
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
        return "edit-invoice/main.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  94 => 58,  92 => 57,  67 => 34,  65 => 33,  44 => 14,  42 => 13,  31 => 4,  28 => 3,);
    }
}
