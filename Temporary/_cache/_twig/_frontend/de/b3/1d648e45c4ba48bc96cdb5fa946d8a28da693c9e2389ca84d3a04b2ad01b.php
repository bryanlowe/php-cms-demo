<?php

/* invoices/invoice-entry.html */
class __TwigTemplate_deb31d648e45c4ba48bc96cdb5fa946d8a28da693c9e2389ca84d3a04b2ad01b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        if ((isset($context["INVOICE_ENTRIES"]) ? $context["INVOICE_ENTRIES"] : null)) {
            // line 2
            echo "\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["INVOICE_ENTRIES"]) ? $context["INVOICE_ENTRIES"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["invoice"]) {
                // line 3
                echo "\t\t<tr>
\t\t\t<td>
\t\t\t\t<a id=\"invoice_";
                // line 5
                echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "_id");
                echo "\" class=\"toggleDesc\">";
                echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "invoice_number");
                echo "</a>
\t\t\t\t<div id=\"invoice_";
                // line 6
                echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "_id");
                echo "_desc\" class=\"hide\">
\t\t\t\t\t";
                // line 7
                if (twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "project_list")) {
                    // line 8
                    echo "\t\t\t\t\t\t<h3>Project List:</h3>
\t\t\t\t\t\t<div class=\"list-group\">
\t\t\t\t\t\t\t";
                    // line 10
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable(twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "project_list"));
                    foreach ($context['_seq'] as $context["_key"] => $context["project"]) {
                        // line 11
                        echo "\t\t\t\t\t\t\t\t<div class=\"list-group-item\">";
                        echo twig_template_get_attributes($this, (isset($context["project"]) ? $context["project"] : null), "project_title");
                        echo "</div>
\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['project'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 13
                    echo "\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clear\"><hr></div>
\t\t\t\t\t";
                }
                // line 16
                echo "\t\t\t\t\t<h3>Description:</h3>
\t\t\t\t\t<p>";
                // line 17
                echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "invoice_description");
                echo "</p>
\t\t\t\t</div>
\t\t\t</td>
\t\t\t<td style=\"white-space: nowrap;\">";
                // line 20
                echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "invoice_date");
                echo "</td>
\t\t\t<td>";
                // line 21
                echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "invoice_cost");
                echo "</td>
\t\t\t<td>
\t\t\t\t<a href=\"https://contentequalsmoney.com/pay-invoice-online/?invoice_id=";
                // line 23
                echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "wp_invoice_id");
                echo "&format=pdf\" target=\"_blank\">PDF</a>
\t\t\t</td>
\t\t\t";
                // line 25
                if ((twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "invoice_status") == "PAID")) {
                    // line 26
                    echo "\t\t\t\t<td><span class=\"btn btn-success\">";
                    echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "invoice_status");
                    echo "</span></td>
\t\t\t\t<td>
\t\t\t\t\t<a href=\"https://contentequalsmoney.com/pay-invoice-online/?invoice_id=";
                    // line 28
                    echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "wp_invoice_id");
                    echo "\" target=\"_blank\">View</a>
\t\t\t\t</td>
\t\t\t";
                } else {
                    // line 31
                    echo "\t\t\t\t<td><span class=\"btn btn-danger\">";
                    echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "invoice_status");
                    echo "</span></td>
\t\t\t\t<td>
\t\t\t\t\t<a href=\"https://contentequalsmoney.com/pay-invoice-online/?invoice_id=";
                    // line 33
                    echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "wp_invoice_id");
                    echo "\" target=\"_blank\">Pay</a>
\t\t\t\t</td>
\t\t\t";
                }
                // line 36
                echo "\t\t</tr>\t\t
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['invoice'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 39
            echo "<tr><td colspan=\"5\"><p align=\"center\">There are no active invoices to show.</p></td></tr>
";
        }
    }

    public function getTemplateName()
    {
        return "invoices/invoice-entry.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  121 => 39,  113 => 36,  107 => 33,  101 => 31,  95 => 28,  89 => 26,  87 => 25,  82 => 23,  77 => 21,  73 => 20,  67 => 17,  64 => 16,  59 => 13,  50 => 11,  46 => 10,  42 => 8,  40 => 7,  36 => 6,  30 => 5,  26 => 3,  21 => 2,  19 => 1,  56 => 26,  54 => 25,  31 => 4,  28 => 3,);
    }
}
