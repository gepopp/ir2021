<?php


namespace immobilien_redaktion_2020;


class TailwindNavWalker extends \Walker_Nav_Menu
{


    private $curItem;


    function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {

        $this->curItem = $item;

        $object = $item->object;

// wp_die(var_dump($item));


        $type = $item->type;
        $title = $item->title;
        $description = $item->description;
        $permalink = $item->url ?? '';

        if ($depth == 0) {
            $class = 'text-white uppercase';
        } else {
            $class = 'text-lg font-bold flex items-center space-x-3 hover:underline';
        }


        $output .= '<li class=""';
        if ($args->walker->has_children ?? false) {
            $output .= ' @mouseenter="open = ' . $item->ID . '"';
        }
        $output .= '>';

        if ($permalink && $permalink != '#') {
            $output .= '<a href="' . $permalink . '" class="' . $class . '"';
            if ($item->object == 'category') {
                $color = get_field('field_5c63ff4b7a5fb', get_category($item->object_id));
                $output .= ' style="background: linear-gradient(0deg, ' . $color . ' 0%, ' . $color . ' 50%, transparent 50%, transparent 100%);"';
            }
            $output .= '>';
        } else {
            $output .= '<span>';
        }

        $output .= $title;

        if ($permalink && $permalink != '#') {
            $output .= '</a>';
        } else {
            $output .= '</span>';
        }

    }


    function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= '</li>';
    }

    function start_lvl(&$output, $depth = 0, $args = null)
    {



        $output .= '<div class="absolute mt-2 p-5 z-50 shadow-lg bg-white w-64 text-black" x-show="open == ' . $this->curItem->ID . '" @mouseleave="open = false" x-cloak><ul>';
    }

    function end_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= '</ul></div>';
    }

}

/**
 * <li class="uppercase text-white mr-3" @click.away="lesen = false">
 * <a href="/lesen" class="cursor-pointer" @mouseenter="lesen = !lesen">LESEN</a>
 * <div class="absolute mt-2 p-5 z-50 shadow-lg bg-white w-64 text-black" x-show="lesen" @mouseleave="lesen = false" x-cloak>
 * <?php $cats = get_categories(['exclude' => [1, 17], 'parent' => 0]) ?>
 * <nav itemscope itemtype="http://schema.org/SiteNavigationElement">
 * <ul>
 * <?php foreach ($cats as $cat): ?>
 * <li class="flex justify-between">
 * <?php $color = get_field('field_5c63ff4b7a5fb', $cat) ?>
 * <a href="<?php echo get_category_link($cat) ?>" class="text-lg font-bold flex items-center space-x-3 hover:underline" style="background: linear-gradient(0deg, <?php echo $color ?> 0%, <?php echo $color ?> 50%, transparent 50%, transparent 100%);">
 * <?php echo $cat->name ?>
 * </a>
 * </li>
 * <?php endforeach; ?>
 * </ul>
 * </nav>
 * </div>
 * </li>
 * <li class="uppercase text-white mr-3">
 * <a href="/sehen">SEHEN</a>
 * </li>
 * <li class="uppercase text-white mr-3"><a href="/diskutieren">LIVE</a></li>
 * </ul>
 */