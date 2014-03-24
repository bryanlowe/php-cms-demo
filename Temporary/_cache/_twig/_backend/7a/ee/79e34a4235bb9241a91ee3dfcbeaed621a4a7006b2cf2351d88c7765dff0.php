<?php

/* clients/list-group-item.html */
class __TwigTemplate_7aee79e34a4235bb9241a91ee3dfcbeaed621a4a7006b2cf2351d88c7765dff0 extends Twig_Template
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
        if ((twig_length_filter($this->env, (isset($context["PROJECT_TAGS"]) ? $context["PROJECT_TAGS"] : null)) > 0)) {
            // line 2
            echo "\t";
            echo twig_join_filter((isset($context["PROJECT_TAGS"]) ? $context["PROJECT_TAGS"] : null), ", ");
            echo "
";
        }
    }

    public function getTemplateName()
    {
        return "clients/list-group-item.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  21 => 2,  19 => 1,);
    }
}
