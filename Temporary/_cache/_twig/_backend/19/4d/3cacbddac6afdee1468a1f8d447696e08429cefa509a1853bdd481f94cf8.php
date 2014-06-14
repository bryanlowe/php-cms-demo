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
        echo "<div class=\"container task-panel\">
\t<div class=\"row\">
    <h1 class=\"col-lg-12\"><i class=\"fa fa-money\"></i> Client Control Panel</h1>
\t\t<!-- Feedback Block -->
\t\t<div class=\"col-lg-3\">
        ";
        // line 9
        if (((isset($context["POST_COUNT"]) ? $context["POST_COUNT"] : null) > 0)) {
            // line 10
            echo "          <div id=\"feedback-container\" class=\"panel panel-success\">
        ";
        } else {
            // line 12
            echo "            <div id=\"feedback-container\" class=\"panel panel-info\">
        ";
        }
        // line 14
        echo "          \t<div class=\"panel-heading\">
            \t<div class=\"row\">
                \t<div class=\"col-xs-6\">
                  \t<i class=\"fa fa-comment fa-5x\"></i>
                \t</div>
                \t<div id=\"feedback-title\" class=\"col-xs-6 text-right\">
                    ";
        // line 20
        if (((isset($context["POST_COUNT"]) ? $context["POST_COUNT"] : null) > 0)) {
            // line 21
            echo "                      <p class=\"announcement-heading\">";
            echo (isset($context["POST_COUNT"]) ? $context["POST_COUNT"] : null);
            echo "</p>
                      <p class=\"announcement-text\">New Feedback!</p>
                    ";
        } else {
            // line 24
            echo "                  \t  <p class=\"task-title\">Feedback</p>
                    ";
        }
        // line 26
        echo "                \t</div>
            \t</div>
          \t</div>
          \t<a href=\"";
        // line 29
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
      ";
        // line 47
        if (((isset($context["ORDER_COUNT"]) ? $context["ORDER_COUNT"] : null) > 0)) {
            // line 48
            echo "        <div id=\"order-container\" class=\"panel panel-success\">
      ";
        } else {
            // line 50
            echo "          <div id=\"order-container\" class=\"panel panel-info\">
      ";
        }
        // line 52
        echo "        <div class=\"panel-heading\">
          <div class=\"row\">
            <div class=\"col-xs-6\">
              <i class=\"fa fa-pencil-square fa-5x\"></i>
            </div>
            <div id=\"order-title\" class=\"col-xs-6 text-right\">
              ";
        // line 58
        if (((isset($context["ORDER_COUNT"]) ? $context["ORDER_COUNT"] : null) > 0)) {
            // line 59
            echo "                <p class=\"announcement-heading\">";
            echo (isset($context["ORDER_COUNT"]) ? $context["ORDER_COUNT"] : null);
            echo "</p>
                <p class=\"announcement-text\">New Orders!</p>
              ";
        } else {
            // line 62
            echo "                <p class=\"task-title\">Orders</p>
              ";
        }
        // line 64
        echo "            </div>
          </div>
        </div>
        <a href=\"";
        // line 67
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
        // line 95
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
        // line 124
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
  </div>
  <div class=\"row\">
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
        // line 154
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
    <div class=\"col-lg-3\">
      <div class=\"panel panel-info\">
        <div class=\"panel-heading\">
          <div class=\"row\">
            <div class=\"col-xs-6\">
              <i class=\"fa fa-eye fa-5x\"></i>
            </div>
            <div class=\"col-xs-6 text-right\">
              <p class=\"task-title\">Preview Invoices</p>
            </div>
          </div>
        </div>
        <a href=\"";
        // line 180
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/preview-invoices\">
          <div class=\"panel-footer announcement-bottom\">
            <div class=\"row\">
              <div class=\"col-xs-6\">
                View Invoices
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
        // line 209
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
    <div class=\"col-lg-3\">
        <div class=\"panel panel-info\">
            <div class=\"panel-heading\">
              <div class=\"row\">
                  <div class=\"col-xs-6\">
                    <i class=\"fa fa-eye fa-5x\"></i>
                  </div>
                  <div class=\"col-xs-6 text-right\">
                    <p class=\"task-title\">Preview Projects</p>
                  </div>
              </div>
            </div>
            <a href=\"";
        // line 235
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/preview-projects\">
              <div class=\"panel-footer announcement-bottom\">
                  <div class=\"row\">
                    <div class=\"col-xs-6\">
                      View Projects
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
\t</div>
  <div class=\"row\">
    <h1 class=\"col-lg-12\"><i class=\"fa fa-pencil-square-o\"></i> Writer Control Panel</h1>
    <!-- Writer Block -->
    <div class=\"col-lg-3\">
        <div class=\"panel panel-info\">
            <div class=\"panel-heading\">
              <div class=\"row\">
                  <div class=\"col-xs-6\">
                    <i class=\"fa fa-pencil fa-5x\"></i>
                  </div>
                  <div class=\"col-xs-6 text-right\">
                    <p class=\"task-title\">Writers</p>
                  </div>
              </div>
            </div>
            <a href=\"";
        // line 266
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/writers\">
              <div class=\"panel-footer announcement-bottom\">
                  <div class=\"row\">
                    <div class=\"col-xs-6\">
                      Edit Writers
                    </div>
                    <div class=\"col-xs-6 text-right\">
                        <i class=\"fa fa-arrow-circle-right\"></i>
                    </div>
                  </div>
              </div>
            </a>
        </div>
    </div>
    <!-- End Writer Block -->
    <!-- Opt-in Block -->
    <div class=\"col-lg-3\">
        <div class=\"panel panel-info\">
            <div class=\"panel-heading\">
              <div class=\"row\">
                  <div class=\"col-xs-6\">
                    <i class=\"fa fa-share-square fa-5x\"></i>
                  </div>
                  <div class=\"col-xs-6 text-right\">
                    <p class=\"task-title\">Opt-ins</p>
                  </div>
              </div>
            </div>
            <a href=\"";
        // line 294
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/opt_in\">
              <div class=\"panel-footer announcement-bottom\">
                  <div class=\"row\">
                    <div class=\"col-xs-8\">
                      Edit Writer Opt-ins
                    </div>
                    <div class=\"col-xs-4 text-right\">
                        <i class=\"fa fa-arrow-circle-right\"></i>
                    </div>
                  </div>
              </div>
            </a>
        </div>
    </div>
    <!-- End Opt-in Block -->
    <!-- Schedule Block -->
    <div class=\"col-lg-3\">
        <div class=\"panel panel-info\">
            <div class=\"panel-heading\">
              <div class=\"row\">
                  <div class=\"col-xs-6\">
                    <i class=\"fa fa-calendar fa-5x\"></i>
                  </div>
                  <div class=\"col-xs-6 text-right\">
                    <p class=\"task-title\">Schedule</p>
                  </div>
              </div>
            </div>
            <a href=\"";
        // line 322
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/schedule\">
              <div class=\"panel-footer announcement-bottom\">
                  <div class=\"row\">
                    <div class=\"col-xs-8\">
                      Edit/View Schedule
                    </div>
                    <div class=\"col-xs-4 text-right\">
                        <i class=\"fa fa-arrow-circle-right\"></i>
                    </div>
                  </div>
              </div>
            </a>
        </div>
    </div>
    <!-- End Schedule Block -->
  </div>
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
        return array (  413 => 322,  382 => 294,  351 => 266,  317 => 235,  288 => 209,  256 => 180,  227 => 154,  194 => 124,  162 => 95,  131 => 67,  126 => 64,  122 => 62,  115 => 59,  113 => 58,  105 => 52,  101 => 50,  97 => 48,  95 => 47,  74 => 29,  69 => 26,  65 => 24,  58 => 21,  56 => 20,  48 => 14,  44 => 12,  40 => 10,  38 => 9,  31 => 4,  28 => 3,);
    }
}
