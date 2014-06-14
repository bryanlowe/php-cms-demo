<?php

/* invoices/main.html */
class __TwigTemplate_93e1e88e1afab7631f1b52446ec8532e8f0d98f6195dd1005cfd536655cd1bae extends Twig_Template
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
        echo "<div id=\"container\">
\t<div class=\"row task-panel\">
\t\t<div class=\"col-lg-8\">
\t\t\t<div class=\"panel panel-primary\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t<h3 class=\"panel-title\"><i class=\"fa fa-envelope\"></i> Invoices</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t<div class=\"table-responsive\">
\t\t\t\t\t\t<table id=\"invoiceHistoryTbl\" class=\"table table-bordered table-hover table-striped tablesorter\">
\t\t\t\t\t\t\t<thead>
\t\t                    \t<tr>
\t\t\t                        <th class=\"header\">Invoice # <i class=\"fa fa-sort\"></i></th>
\t\t\t                        <th class=\"header\">Last Updated <i class=\"fa fa-sort\"></i></th>
\t\t\t                        <th class=\"header\">Amount (USD) <i class=\"fa fa-sort\"></i></th>
\t\t\t                        <th class=\"header\">File <i class=\"fa fa-sort\"></i></th>
\t\t\t                        <th class=\"header\">Status <i class=\"fa fa-sort\"></i></th>
\t\t\t                        <th>&nbsp;</th>
\t\t                      \t</tr>
\t                      \t</thead>
\t                      \t<tbody id=\"invoice_entries\">
\t                      \t\t";
        // line 25
        $this->env->loadTemplate("invoices/invoice-entry.html")->display($context);
        // line 26
        echo "              \t\t\t\t</tbody>
                 \t \t</table>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-lg-4\">
\t\t\t<div class=\"panel panel-primary\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t<h3 class=\"panel-title\"><i class=\"fa fa-search\"></i> Invoice Description</h3>
\t\t\t\t</div>
\t\t\t\t<div id=\"invoiceDesc\" class=\"panel-body\">
\t\t\t\t\t<p>Click on an invoice number to view its description.</p>
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
        return array (  56 => 26,  54 => 25,  31 => 4,  28 => 3,);
    }
}
