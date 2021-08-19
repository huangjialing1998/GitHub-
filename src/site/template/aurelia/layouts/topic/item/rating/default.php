<?php
/**
 * Kunena Component
 *
 * @package         Kunena.Template.Aurelia
 * @subpackage      Layout.Topic
 *
 * @copyright       Copyright (C) 2008 - 2021 Kunena Team. All rights reserved.
 * @license         https://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link            https://www.kunena.org
 **/

namespace Kunena\Forum\Site;

defined('_JEXEC') or die();

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Kunena\Forum\Libraries\Route\KunenaRoute;
use function defined;

if ($this->category->allowRatings) :
	$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
	$wa->registerAndUseStyle('fileupload', 'media/kunena/core/css/rating.css')
		->registerAndUseScript('rating', 'media/kunena/core/js/rating.js')
		->registerAndUseScript('krating', 'media/kunena/core/js/krating.js'); ?>

    <input id="topic_id" type="hidden" value="<?php echo $this->topic->id; ?>"/>
    <input type="hidden" id="krating_url" name="krating_url"
           value="<?php echo KunenaRoute::_('index.php?option=com_kunena&view=topic&layout=getrate&format=raw'); ?>"/>
    <input type="hidden" id="krating_submit_url" name="url"
           value="<?php echo KunenaRoute::_('index.php?option=com_kunena&view=topic&layout=rate&topic_id=' . $this->topic->id . '&format=raw'); ?>"/>
    <div id="krating"
         title="<?php echo Text::sprintf('COM_KUNENA_RATE_TOOLTIP', $this->topic->rating, $this->topic->getReviewCount()); ?>"
         class="hasTooltip">
        <p class="unseen element-invisible"></p>
    </div>
<?php endif;