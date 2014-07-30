<?php

/* invoices/invoice-entry.html */
class __TwigTemplate_08dd92c0704450d710eff40790d1397ebac70c85148bac6d8890657faa6ca2f0 extends Twig_Template
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
                echo "\" class=\"loadInvoice\">Period: ";
                echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "period_start");
                echo " - ";
                echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "period_end");
                echo "</a>
\t\t\t</td>
\t\t\t<td style=\"white-space: nowrap;\">";
                // line 7
                echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "invoice_date");
                echo "</td>
\t\t\t<td>\$";
                // line 8
                echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "invoice_cost");
                echo "</td>
\t\t\t";
                // line 9
                if ((twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "invoice_status") == "PAID")) {
                    // line 10
                    echo "\t\t\t\t<td style=\"text-align: center\"><span class=\"btn btn-success\">";
                    echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "invoice_status");
                    echo "</span></td>
\t\t\t";
                } else {
                    // line 12
                    echo "\t\t\t\t<td style=\"text-align: center\"><span class=\"btn btn-info\">";
                    echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "invoice_status");
                    echo "</span></td>
\t\t\t";
                }
                // line 14
                echo "\t\t\t<td style=\"text-align: center\"><a id=\"print_";
                echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "_id");
                echo "\" class=\"btn btn-info printInvoice\">PDF</a></td>
\t\t</tr>\t\t
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['invoice'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 18
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
        return array (  72 => 18,  61 => 14,  55 => 12,  49 => 10,  47 => 9,  43 => 8,  39 => 7,  30 => 5,  26 => 3,  21 => 2,  19 => 1,);
    }
}
