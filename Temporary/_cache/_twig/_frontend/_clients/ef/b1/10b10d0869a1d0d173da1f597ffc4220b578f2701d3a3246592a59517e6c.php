<?php

/* account/main.html */
class __TwigTemplate_efb110b10d0869a1d0d173da1f597ffc4220b578f2701d3a3246592a59517e6c extends Twig_Template
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
\t<div id=\"order_tips\" class=\"alert alert-success alert-dismissable\">
\t    <p><strong>Tip #1:</strong> The rate calculator is only available if we have already calulated your rate for the year. If you do not have a rate, please contact us at <a href=\"mailto:info@contentequalsmoney.com\">info@contentequalsmoney.com</a></p>

\t\t<p><strong>Tip #2:</strong> If your rate has been calculated already then the rate calculator is avialable to you. Your rate is represented next to \"Current Rate:\". The first slider represents the amounts of words your project will have per piece. The second slider represents the amount of pieces that will be created for your order. When each slider has a value, a dollar amount next to \"Price:\" will be presented as the quote for the order.</p>

\t\t<p><strong>Tip #3:</strong> In order to calculate many different orders together, you need to press the \"Update Quote\" button. This will add quotes as your create them and total them in \"Project Total:\".</p>
\t</div>
\t<div class=\"row task-panel\">
\t\t<div class=\"col-lg-6\">
\t\t\t<div class=\"panel panel-primary\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t<h3 class=\"panel-title\">Edit Account Information</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t";
        // line 19
        echo (isset($context["CLIENT_FORM"]) ? $context["CLIENT_FORM"] : null);
        echo "
\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t<div class=\"button_panel\">
\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-success\" value=\"SAVE\" name=\"submitBtn\" id=\"submitBtn\">
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"col-lg-5\">
\t\t\t<div class=\"panel panel-primary\" style=\"margin-bottom: 15px;\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t<h3 class=\"panel-title\">Rate Calculator</h3>
\t\t\t\t</div>
\t\t\t\t<div id=\"rateCalc\" class=\"panel-body\">
\t\t\t\t\t";
        // line 35
        if (((isset($context["CLIENT_RATE"]) ? $context["CLIENT_RATE"] : null) > 0)) {
            // line 36
            echo "\t\t\t\t\t\t<form id=\"formCalc\">
\t\t\t\t\t\t\t<p class=\"pricepara form-control-static\">Current Rate: \$";
            // line 37
            echo (isset($context["CLIENT_RATE"]) ? $context["CLIENT_RATE"] : null);
            echo " per word</p>
\t\t\t\t\t\t\t<p class=\"pricepara\">
\t\t                        Price:  
\t\t                        <label for=\"total\" id=\"totalprice\" style=\"\"></label>
\t\t                        <input name=\"totalprice\" type=\"text\" id=\"total\" disabled=\"disabled\" style=\"\" />
\t\t                    </p>    
\t\t                    <div id=\"quoteme\">
\t\t                        <div id=\"slider\"></div>
\t\t                        <label for=\"amount\"></label>
\t\t                        <input name=\"one\" style=\"width: 266px;\" type=\"text\" id=\"amount\" value= disabled=\"disabled\" />
\t\t                        <label for=\"price\"></label>
\t\t                        <input name=\"onea\" type=\"text\" id=\"price\" value= disabled=\"disabled\" />

\t\t                        <div id=\"sliderb\"></div>
\t\t                        <label for=\"amountb\"></label>
\t\t                        <input name=\"two\" style=\"width: 266px;\"  type=\"text\" id=\"amountb\" value= disabled=\"disabled\" />
\t\t                        <label for=\"priceb\"></label>
\t\t                        <input name=\"twoa\" type=\"text\" id=\"priceb\" value= disabled=\"disabled\" />
\t\t                    </div>
\t\t                </form>
\t\t                <div class=\"clear\"><hr></div>
\t                    <p id=\"project_total_container\" class=\"pricepara\">
\t                        Project Total:  
\t                        <input name=\"project_total\" type=\"text\" id=\"project_total\" readonly style=\"\" />
\t                    </p>
\t                    <div class=\"clear\"></div>
\t                    <div class=\"saveBtn_container\"><input type=\"button\" class=\"btn btn-success\" id=\"updateQuote\" value=\"UPDATE QUOTE\"></div>
                    ";
        } else {
            // line 65
            echo "                    \t<p>Looks like you don&#39;t have an established per word rate. Make an appt with Amie for your initial consult or use our <a href=\"https://contentequalsmoney.com/price1/\" target=\"_blank\">pricing wizard</a> to find your rate. Once your rate is established it stays consistent for any project in ";
            echo (isset($context["COPY_YEAR"]) ? $context["COPY_YEAR"] : null);
            echo ".</p>
                    ";
        }
        // line 67
        echo "\t\t\t\t</div>
\t\t\t</div>
\t\t\t";
        // line 69
        if (((isset($context["CLIENT_RATE"]) ? $context["CLIENT_RATE"] : null) > 0)) {
            // line 70
            echo "\t\t\t<h3>Having trouble with multiple quotes?</h3>
\t\t\t<p>Check the example below:</p>
\t\t\t<p><img src=\"";
            // line 72
            echo (isset($context["IMAGEPATH"]) ? $context["IMAGEPATH"] : null);
            echo "/_cem/quote_example.jpg\" /></p>
\t\t\t";
        }
        // line 74
        echo "\t\t</div>
\t</div>
</div>
<input type=\"hidden\" id=\"client_rate\" value=\"";
        // line 77
        echo (isset($context["CLIENT_RATE"]) ? $context["CLIENT_RATE"] : null);
        echo "\" />
";
    }

    public function getTemplateName()
    {
        return "account/main.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  129 => 77,  124 => 74,  119 => 72,  115 => 70,  113 => 69,  109 => 67,  103 => 65,  72 => 37,  69 => 36,  67 => 35,  48 => 19,  31 => 4,  28 => 3,);
    }
}
