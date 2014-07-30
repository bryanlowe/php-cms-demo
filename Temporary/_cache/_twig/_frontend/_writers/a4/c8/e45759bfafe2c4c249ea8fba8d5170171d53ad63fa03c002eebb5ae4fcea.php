<?php

/* invoices/invoice-details.html */
class __TwigTemplate_a4c8e45759bfafe2c4c249ea8fba8d5170171d53ad63fa03c002eebb5ae4fcea extends Twig_Template
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
        if ((isset($context["INVOICE_DETAILS"]) ? $context["INVOICE_DETAILS"] : null)) {
            // line 2
            echo "\t<h2 align=\"center\">Period: ";
            echo (isset($context["START_DATE"]) ? $context["START_DATE"] : null);
            echo " to ";
            echo (isset($context["END_DATE"]) ? $context["END_DATE"] : null);
            echo "</h2>
\t<table id=\"invoiceDetailsTbl\" class=\"table table-bordered table-hover table-striped tablesorter\">
\t\t<thead>
\t    \t<tr>
\t            <th class=\"header\">Project Title <i class=\"fa fa-sort\"></i></th>
\t            <th class=\"header\">Work Description <i class=\"fa fa-sort\"></i></th>
\t            <th class=\"header\">Date <i class=\"fa fa-sort\"></i></th>
\t            <th class=\"header\">Hours <i class=\"fa fa-sort\"></i></th>
\t            <th class=\"header\">Total <i class=\"fa fa-sort\"></i></th>
\t      \t</tr>
\t  \t</thead>
\t  \t<tbody id=\"INVOICE_DETAILS\">
\t\t";
            // line 14
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["INVOICE_DETAILS"]) ? $context["INVOICE_DETAILS"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["invoice"]) {
                // line 15
                echo "\t\t\t<tr>
\t\t\t\t<td>";
                // line 16
                echo twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "work_details"), "project_title");
                echo "</td>
\t\t\t\t<td>";
                // line 17
                echo twig_template_get_attributes($this, twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "work_details"), "work_hours"), "description");
                echo "</td>
\t\t\t\t<td align=\"right\">";
                // line 18
                echo twig_template_get_attributes($this, twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "work_details"), "work_hours"), "date");
                echo "</td>
\t\t\t\t<td align=\"right\">";
                // line 19
                echo twig_template_get_attributes($this, twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "work_details"), "work_hours"), "hours");
                echo "</td>
\t\t\t\t<td align=\"right\">\$";
                // line 20
                echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "total_due");
                echo "</td>
\t\t\t</tr>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['invoice'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 23
            echo "\t\t</tbody>
    </table>
    ";
            // line 25
            if (((isset($context["INVOICE_STATUS"]) ? $context["INVOICE_STATUS"] : null) == "OPEN")) {
                // line 26
                echo "    \t<p align=\"right\"><strong>Total Due: \$";
                echo (isset($context["TOTAL_DUE"]) ? $context["TOTAL_DUE"] : null);
                echo "</strong></p>
    \t";
                // line 27
                if (((isset($context["TOTAL_DUE"]) ? $context["TOTAL_DUE"] : null) != (isset($context["TOTAL_PENDING"]) ? $context["TOTAL_PENDING"] : null))) {
                    // line 28
                    echo "    \t\t<p align=\"right\"><strong>Total Pending: \$";
                    echo (isset($context["TOTAL_PENDING"]) ? $context["TOTAL_PENDING"] : null);
                    echo "</strong></p>\t
    \t";
                }
                // line 30
                echo "    ";
            } else {
                // line 31
                echo "    \t<p align=\"right\"><strong>Total Paid: \$";
                echo (isset($context["TOTAL_DUE"]) ? $context["TOTAL_DUE"] : null);
                echo "</strong></p>
    \t<p align=\"right\"><strong>Total Paid to date: \$";
                // line 32
                echo (isset($context["TOTAL_PAID"]) ? $context["TOTAL_PAID"] : null);
                echo "</strong></p>
    ";
            }
        } else {
            // line 35
            echo "\t<p align=\"center\">There are no invoice details to show.</p>
";
        }
    }

    public function getTemplateName()
    {
        return "invoices/invoice-details.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  104 => 35,  98 => 32,  93 => 31,  90 => 30,  84 => 28,  82 => 27,  77 => 26,  75 => 25,  71 => 23,  62 => 20,  58 => 19,  54 => 18,  50 => 17,  46 => 16,  43 => 15,  39 => 14,  21 => 2,  19 => 1,);
    }
}
