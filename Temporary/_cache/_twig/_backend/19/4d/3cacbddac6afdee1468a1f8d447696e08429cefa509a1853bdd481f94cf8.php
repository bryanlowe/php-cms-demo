<?php

/* home/main.html */
class __TwigTemplate_194d3cacbddac6afdee1468a1f8d447696e08429cefa509a1853bdd481f94cf8 extends Twig_Template
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
  <div class=\"alert alert-success alert-dismissable\">
    Welcome to the Content Equals Money Dashboard - Admin Edition! In this portal you are able to manage various aspects of the client dashboard. Please choose a task from the buttons below in order to edit or view information on the client dashboard.
  </div>
\t<div class=\"row task-panel\">
\t\t<!-- Feedback Block -->
\t\t<div class=\"col-lg-3 col-lg-offset-3\">
        <div id=\"feedback-container\" class=\"panel panel-info\">
          \t<div class=\"panel-heading\">
            \t<div class=\"row\">
                \t<div class=\"col-xs-6\">
                  \t<i class=\"fa fa-comment fa-5x\"></i>
                \t</div>
                \t<div id=\"feedback-title\" class=\"col-xs-6 text-right\">
                  \t<p class=\"task-title\">Feedback</p>
                \t</div>
            \t</div>
          \t</div>
          \t<a href=\"";
        // line 22
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/feedback\">
            \t<div class=\"panel-footer announcement-bottom\">
                \t<div class=\"row\">
                  \t<div class=\"col-xs-6\">
                   \t\tView Feedback
                  \t</div>
                  \t<div class=\"col-xs-6 text-right\">
                    \t\t<i class=\"fa fa-arrow-circle-right\"></i>
                  \t</div>
                \t</div>
            \t</div>
          \t</a>
        </div>
    </div>
    <!-- End Feedback Block -->

    <!-- Order Block -->
    <div class=\"col-lg-3\">
      <div id=\"order-container\" class=\"panel panel-info\">
        <div class=\"panel-heading\">
          <div class=\"row\">
            <div class=\"col-xs-6\">
              <i class=\"fa fa-pencil-square fa-5x\"></i>
            </div>
            <div id=\"order-title\" class=\"col-xs-6 text-right\">
              <p class=\"task-title\">Orders</p>
            </div>
          </div>
        </div>
        <a href=\"";
        // line 51
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/orders\">
          <div class=\"panel-footer announcement-bottom\">
            <div class=\"row\">
              <div class=\"col-xs-6\">
                View Orders
              </div>
              <div class=\"col-xs-6 text-right\">
                <i class=\"fa fa-arrow-circle-right\"></i>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
    <!-- End Order Block -->
\t</div>
\t<div class=\"row\">
\t\t<!-- Client Block -->
    <div class=\"col-lg-3\">
        <div class=\"panel panel-info\">
            <div class=\"panel-heading\">
              <div class=\"row\">
                  <div class=\"col-xs-6\">
                    <i class=\"fa fa-suitcase fa-5x\"></i>
                  </div>
                  <div class=\"col-xs-6 text-right\">
                    <p class=\"task-title\">Clients</p>
                  </div>
              </div>
            </div>
            <a href=\"";
        // line 81
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/clients\">
              <div class=\"panel-footer announcement-bottom\">
                  <div class=\"row\">
                    <div class=\"col-xs-6\">
                      Edit Clients
                    </div>
                    <div class=\"col-xs-6 text-right\">
                        <i class=\"fa fa-arrow-circle-right\"></i>
                    </div>
                  </div>
              </div>
            </a>
        </div>
    </div>
    <!-- End Client Block -->

    <!-- Invoice Block -->
    <div class=\"col-lg-3\">
      <div class=\"panel panel-info\">
        <div class=\"panel-heading\">
          <div class=\"row\">
            <div class=\"col-xs-6\">
              <i class=\"fa fa-envelope fa-5x\"></i>
            </div>
            <div class=\"col-xs-6 text-right\">
              <p class=\"task-title\">Invoices</p>
            </div>
          </div>
        </div>
        <a href=\"";
        // line 110
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/invoices\">
          <div class=\"panel-footer announcement-bottom\">
            <div class=\"row\">
              <div class=\"col-xs-6\">
                Edit Invoices
              </div>
              <div class=\"col-xs-6 text-right\">
                <i class=\"fa fa-arrow-circle-right\"></i>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
    <!-- End Invoice Block -->

    <!-- Project Block -->
    <div class=\"col-lg-3\">
        <div class=\"panel panel-info\">
            <div class=\"panel-heading\">
              <div class=\"row\">
                  <div class=\"col-xs-6\">
                    <i class=\"fa fa-tasks fa-5x\"></i>
                  </div>
                  <div class=\"col-xs-6 text-right\">
                    <p class=\"task-title\">Projects</p>
                  </div>
              </div>
            </div>
            <a href=\"";
        // line 139
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/projects\">
              <div class=\"panel-footer announcement-bottom\">
                  <div class=\"row\">
                    <div class=\"col-xs-6\">
                      Edit Projects
                    </div>
                    <div class=\"col-xs-6 text-right\">
                        <i class=\"fa fa-arrow-circle-right\"></i>
                    </div>
                  </div>
              </div>
            </a>
        </div>
    </div>
    <!-- End Project Block -->

    <!-- User Block -->
    <div class=\"col-lg-3\">
      <div class=\"panel panel-info\">
        <div class=\"panel-heading\">
          <div class=\"row\">
            <div class=\"col-xs-6\">
              <i class=\"fa fa-users fa-5x\"></i>
            </div>
            <div class=\"col-xs-6 text-right\">
              <p class=\"task-title\">Users</p>
            </div>
          </div>
        </div>
        <a href=\"";
        // line 168
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/users\">
          <div class=\"panel-footer announcement-bottom\">
            <div class=\"row\">
              <div class=\"col-xs-6\">
                Edit Users
              </div>
              <div class=\"col-xs-6 text-right\">
                <i class=\"fa fa-arrow-circle-right\"></i>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
    <!-- End User Block -->
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "home/main.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  212 => 168,  180 => 139,  148 => 110,  116 => 81,  83 => 51,  51 => 22,  31 => 4,  28 => 3,);
    }
}
