<?php

/* users/users_select.html */
class __TwigTemplate_0d525fe2097ad38118a014e3c34c89b5cd1ceff9a751349972ac91ac0a62d061 extends Twig_Template
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
        echo "<label for=\"users_select\">Select a user to edit</label><br>
<select class=\"form-control\" name=\"users_select\" id=\"users_select\">
\t<option value=\"\">Please select a user</option>
\t";
        // line 4
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["SELECT_USERS"]) ? $context["SELECT_USERS"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 5
            echo "\t    <option value=\"";
            echo twig_template_get_attributes($this, (isset($context["user"]) ? $context["user"] : null), "_id");
            echo "\">";
            echo twig_template_get_attributes($this, (isset($context["user"]) ? $context["user"] : null), "fullname");
            echo "</option>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 7
        echo "</select>";
    }

    public function getTemplateName()
    {
        return "users/users_select.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 7,  28 => 5,  24 => 4,  19 => 1,);
    }
}
