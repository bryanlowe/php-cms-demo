<?php

/* feedback/list-group-item.html */
class __TwigTemplate_94fbaedbad142af2d42ee52d7cdfbf13625130aaebb77b81ca93349a3877bbbf extends Twig_Template
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
        echo "<span id=\"fb-entry-";
        echo twig_template_get_attributes($this, (isset($context["post"]) ? $context["post"] : null), "feedback_id");
        echo "\">
\t<a id=\"fb-link-";
        // line 2
        echo twig_template_get_attributes($this, (isset($context["post"]) ? $context["post"] : null), "feedback_id");
        echo "\" class=\"list-group-item\" href=\"javascript:showFeedbackDetails(";
        echo twig_template_get_attributes($this, (isset($context["post"]) ? $context["post"] : null), "feedback_id");
        echo ", ";
        echo twig_template_get_attributes($this, (isset($context["post"]) ? $context["post"] : null), "read_status");
        echo ");\">
\t   <span class=\"badge\">";
        // line 3
        echo twig_template_get_attributes($this, (isset($context["post"]) ? $context["post"] : null), "feedback_date");
        echo "</span>
\t   Feedback: ";
        // line 4
        echo twig_template_get_attributes($this, (isset($context["post"]) ? $context["post"] : null), "customer_name");
        echo " ";
        echo twig_template_get_attributes($this, (isset($context["post"]) ? $context["post"] : null), "company");
        echo "
\t</a>
\t<div id=\"fb-details-";
        // line 6
        echo twig_template_get_attributes($this, (isset($context["post"]) ? $context["post"] : null), "feedback_id");
        echo "\" style=\"display: none;\">
\t\t";
        // line 7
        echo twig_template_get_attributes($this, (isset($context["post"]) ? $context["post"] : null), "feedback_details");
        echo "
\t\t<p align=\"right\"><i>-- ";
        // line 8
        echo twig_template_get_attributes($this, (isset($context["post"]) ? $context["post"] : null), "customer_name");
        echo " ";
        echo twig_template_get_attributes($this, (isset($context["post"]) ? $context["post"] : null), "company");
        echo "</i></p>
\t</div>
</span>";
    }

    public function getTemplateName()
    {
        return "feedback/list-group-item.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 8,  47 => 7,  36 => 4,  32 => 3,  24 => 2,  19 => 1,  142 => 37,  138 => 35,  135 => 34,  121 => 33,  118 => 32,  100 => 31,  98 => 30,  85 => 19,  81 => 17,  78 => 16,  64 => 15,  61 => 14,  43 => 6,  41 => 12,  31 => 4,  28 => 3,);
    }
}
