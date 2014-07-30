<?php

/* invoices/invoice-pdf.html */
class __TwigTemplate_2d651ab9f104d6eddacacfd3bd25bc618c5d0974a91d4fc24a57f6f656076c4d extends Twig_Template
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
        echo "<page>
\t";
        // line 2
        if ((isset($context["INVOICE_DETAILS"]) ? $context["INVOICE_DETAILS"] : null)) {
            // line 3
            echo "\t\t<h2 align=\"center\">Period: ";
            echo (isset($context["START_DATE"]) ? $context["START_DATE"] : null);
            echo " to ";
            echo (isset($context["END_DATE"]) ? $context["END_DATE"] : null);
            echo "</h2>
\t\t<table id=\"invoiceDetailsTbl\" class=\"table table-bordered table-hover table-striped tablesorter\">
\t\t\t<thead>
\t\t    \t<tr>
\t\t            <th class=\"header\">Project Title</th>
\t\t            <th class=\"header\">Work Description</th>
\t\t            <th class=\"header\">Date</th>
\t\t            <th class=\"header\">Hours</th>
\t\t            <th class=\"header\">Total</th>
\t\t      \t</tr>
\t\t  \t</thead>
\t\t  \t<tbody id=\"INVOICE_DETAILS\">
\t\t\t";
            // line 15
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["INVOICE_DETAILS"]) ? $context["INVOICE_DETAILS"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["invoice"]) {
                // line 16
                echo "\t\t\t\t<tr>
\t\t\t\t\t<td>";
                // line 17
                echo twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "work_details"), "project_title");
                echo "</td>
\t\t\t\t\t<td>";
                // line 18
                echo twig_template_get_attributes($this, twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "work_details"), "work_hours"), "description");
                echo "</td>
\t\t\t\t\t<td align=\"right\">";
                // line 19
                echo twig_template_get_attributes($this, twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "work_details"), "work_hours"), "date");
                echo "</td>
\t\t\t\t\t<td align=\"right\">";
                // line 20
                echo twig_template_get_attributes($this, twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "work_details"), "work_hours"), "hours");
                echo "</td>
\t\t\t\t\t<td align=\"right\">\$";
                // line 21
                echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "total_due");
                echo "</td>
\t\t\t\t</tr>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['invoice'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 24
            echo "\t\t\t</tbody>
\t    </table>
\t";
            // line 26
            if (((isset($context["INVOICE_STATUS"]) ? $context["INVOICE_STATUS"] : null) == "OPEN")) {
                // line 27
                echo "    \t<p align=\"right\"><strong>Total Due: \$";
                echo (isset($context["TOTAL_DUE"]) ? $context["TOTAL_DUE"] : null);
                echo "</strong></p>
    \t";
                // line 28
                if (((isset($context["TOTAL_DUE"]) ? $context["TOTAL_DUE"] : null) != (isset($context["TOTAL_PENDING"]) ? $context["TOTAL_PENDING"] : null))) {
                    // line 29
                    echo "    \t\t<p align=\"right\"><strong>Total Pending: \$";
                    echo (isset($context["TOTAL_PENDING"]) ? $context["TOTAL_PENDING"] : null);
                    echo "</strong></p>\t
    \t";
                }
                // line 31
                echo "    ";
            } else {
                // line 32
                echo "    \t<p align=\"right\"><strong>Total Paid: \$";
                echo (isset($context["TOTAL_DUE"]) ? $context["TOTAL_DUE"] : null);
                echo "</strong></p>
    \t<p align=\"right\"><strong>Total Paid to date: \$";
                // line 33
                echo (isset($context["TOTAL_PAID"]) ? $context["TOTAL_PAID"] : null);
                echo "</strong></p>
    ";
            }
            // line 35
            echo "\t";
        } else {
            // line 36
            echo "\t\t<p align=\"center\">There are no invoice details to show.</p>
\t";
        }
        // line 38
        echo "</page>
";
    }

    public function getTemplateName()
    {
        return "invoices/invoice-pdf.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  113 => 38,  109 => 36,  106 => 35,  101 => 33,  96 => 32,  93 => 31,  87 => 29,  85 => 28,  80 => 27,  78 => 26,  74 => 24,  65 => 21,  61 => 20,  57 => 19,  53 => 18,  49 => 17,  46 => 16,  42 => 15,  24 => 3,  22 => 2,  19 => 1,);
    }
}
