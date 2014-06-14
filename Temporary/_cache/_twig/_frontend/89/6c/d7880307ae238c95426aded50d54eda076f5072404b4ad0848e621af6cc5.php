<?php

/* orders/main.html */
class __TwigTemplate_896cd7880307ae238c95426aded50d54eda076f5072404b4ad0848e621af6cc5 extends Twig_Template
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
\t    <p><strong>Tip #1:</strong> Since we charge per word, you will want to specify a word count range or let us know that you don't care. Many clients say, \"long enough to be comprehensive but short enough to avoid fluff\".</p>

\t\t<p><strong>Tip #2:</strong> Is this the same or similar to a previous project we've done for you? Let us know so we can go back and look at keywords and other specs.</p>

\t\t<p><strong>Tip #3:</strong> Would you like to see pitches first before the full piece? This is always an option, and always free. Pitches take 1-2 business days and then once approved the project will take 2-3 business days. So it depends on your timeline. Note below if you want to see pitches first. :)</p>

\t\t<p><strong>Tip #4:</strong> You can always email Amie directly for orders, she will ask you any questions if you aren't sure what to say. :)</p>
\t</div>
\t<div class=\"row\">
\t\t<div class=\"col-lg-6 col-lg-offset-3\">
\t\t\t<div class=\"panel panel-primary\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t<h3 class=\"panel-title\">Enter a description of what you need. Be as descriptive as possible.</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t";
        // line 21
        echo (isset($context["ORDER_FORM"]) ? $context["ORDER_FORM"] : null);
        echo "
\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t<div class=\"button_panel\">
\t\t\t\t\t\t<div class=\"btn_container\">
\t\t\t\t\t\t\t<input type=\"button\" class=\"btn btn-success\" value=\"PLACE ORDER\" name=\"submitBtn\" id=\"submitBtn\">
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "orders/main.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 21,  31 => 4,  28 => 3,);
    }
}
