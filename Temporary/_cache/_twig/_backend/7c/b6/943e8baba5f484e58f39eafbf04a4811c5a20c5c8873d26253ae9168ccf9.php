<?php

/* edit-invoice/invoice-entry.html */
class __TwigTemplate_7cb6943e8baba5f484e58f39eafbf04a4811c5a20c5c8873d26253ae9168ccf9 extends Twig_Template
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
            echo "\t<h2 align=\"center\">Period: ";
            echo (isset($context["START_DATE"]) ? $context["START_DATE"] : null);
            echo " to ";
            echo (isset($context["END_DATE"]) ? $context["END_DATE"] : null);
            echo "</h2>
\t<table id=\"invoiceTbl\" class=\"table table-bordered table-hover table-striped tablesorter\">
\t\t<thead>
\t    \t<tr>
\t            <th class=\"header\">Project Title <i class=\"fa fa-sort\"></i></th>
\t            <th class=\"header\">Work Description <i class=\"fa fa-sort\"></i></th>
\t            <th class=\"header\">Date <i class=\"fa fa-sort\"></i></th>
\t            <th class=\"header\">Hours <i class=\"fa fa-sort\"></i></th>
\t            <th class=\"header\">Rate <i class=\"fa fa-sort\"></i></th>
\t            <th class=\"header\">Total <i class=\"fa fa-sort\"></i></th>
\t            ";
            // line 12
            if (((isset($context["INVOICE_STATUS"]) ? $context["INVOICE_STATUS"] : null) == "OPEN")) {
                // line 13
                echo "\t            \t<th class=\"header\"></th>
\t            ";
            }
            // line 15
            echo "\t      \t</tr>
\t  \t</thead>
\t  \t<tbody id=\"invoice_entries\">
\t\t";
            // line 18
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["INVOICE_ENTRIES"]) ? $context["INVOICE_ENTRIES"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["invoice"]) {
                // line 19
                echo "\t\t\t<tr>
\t\t\t\t<td>";
                // line 20
                echo twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "work_details"), "project_title");
                echo "</td>
\t\t\t\t<td>";
                // line 21
                echo twig_template_get_attributes($this, twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "work_details"), "work_hours"), "description");
                echo "</td>
\t\t\t\t<td align=\"right\">";
                // line 22
                echo twig_template_get_attributes($this, twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "work_details"), "work_hours"), "date");
                echo "</td>
\t\t\t\t<td align=\"right\">";
                // line 23
                echo twig_template_get_attributes($this, twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "work_details"), "work_hours"), "hours");
                echo "</td>
\t\t\t\t<td align=\"right\">\$";
                // line 24
                echo (isset($context["WRITER_RATE"]) ? $context["WRITER_RATE"] : null);
                echo "</td>
\t\t\t\t<td align=\"right\">\$";
                // line 25
                echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "total_due");
                echo "</td>
\t\t\t\t";
                // line 26
                if (((isset($context["INVOICE_STATUS"]) ? $context["INVOICE_STATUS"] : null) == "OPEN")) {
                    // line 27
                    echo "\t            \t<td align=\"center\"><button class=\"close\" type=\"button\" style=\"float: none;\" onclick=\"removeWorkEntry('";
                    echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "work_id");
                    echo "');\">×</button></td>
\t            ";
                }
                // line 29
                echo "\t\t\t</tr>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['invoice'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 31
            echo "\t\t</tbody>
    </table>
    ";
            // line 33
            if (((isset($context["INVOICE_STATUS"]) ? $context["INVOICE_STATUS"] : null) == "OPEN")) {
                // line 34
                echo "    \t<p align=\"right\"><strong>Total Due: \$";
                echo (isset($context["TOTAL_DUE"]) ? $context["TOTAL_DUE"] : null);
                echo "</strong></p>
    ";
            } else {
                // line 36
                echo "    \t<p align=\"right\"><strong>Total Paid: \$";
                echo (isset($context["TOTAL_DUE"]) ? $context["TOTAL_DUE"] : null);
                echo "</strong></p>
    ";
            }
        } else {
            // line 39
            echo "\t<p align=\"center\">There are no active invoices to show.</p>
";
        }
    }

    public function getTemplateName()
    {
        return "edit-invoice/invoice-entry.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  113 => 39,  106 => 36,  100 => 34,  98 => 33,  94 => 31,  87 => 29,  81 => 27,  79 => 26,  75 => 25,  71 => 24,  67 => 23,  63 => 22,  59 => 21,  55 => 20,  52 => 19,  48 => 18,  43 => 15,  39 => 13,  37 => 12,  21 => 2,  19 => 1,);
    }
}
