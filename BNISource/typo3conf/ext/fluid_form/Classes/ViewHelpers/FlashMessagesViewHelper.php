<?php

namespace CodingMs\FluidForm\ViewHelpers;

/***************************************************************
 *
 * Copyright notice
 *
 * (c) 2019 Thomas Deuling <typo3@coding.ms>
 *
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Fluid\ViewHelpers\FlashMessagesViewHelper as FlashMessagesBaseViewHelper;

/**
 * Render flash messages in Bootstrap style.
 * Additionally merge all equal messages into one.
 *
 * @author Thomas Deuling <typo3@coding.ms>
 */
class FlashMessagesViewHelper extends FlashMessagesBaseViewHelper
{
    /**
     * Renders the flash messages as unordered list
     *
     * @param array $flashMessages array<\TYPO3\CMS\Core\Messaging\FlashMessage>
     * @return string
     */
    protected function renderUl(array $flashMessages)
    {
        return $this->renderDiv($flashMessages);
    }

    /**
     * Renders the flash messages as nested divs
     *
     * @param array $flashMessages array<\TYPO3\CMS\Core\Messaging\FlashMessage>
     * @return string
     */
    protected function renderDiv(array $flashMessages)
    {
        $this->tag->setTagName('div');
        if ($this->hasArgument('class')) {
            $this->tag->addAttribute('class', $this->arguments['class']);
        } else {
            $this->tag->addAttribute('class', 'typo3-messages');
        }

        $tagContents = [];
        /** @var FlashMessage $singleFlashMessage */
        foreach ($flashMessages as $singleFlashMessage) {
            $severity = $singleFlashMessage->getSeverity();
            if ($severity == FlashMessage::NOTICE) {
                $severityKey = 'info';
            } elseif ($severity == FlashMessage::INFO) {
                $severityKey = 'info';
            } elseif ($severity == FlashMessage::OK) {
                $severityKey = 'success';
            } elseif ($severity == FlashMessage::WARNING) {
                $severityKey = 'warning';
            } else {
                $severityKey = 'danger';
            }

            $title = '<strong class="title">' . $singleFlashMessage->getTitle() . '</strong>';
            $message = '<p class="message">' . $singleFlashMessage->getMessage() . '</p>';

            $tagContents[$severityKey][] = '<div class="message">' . $title . $message . '</div>';
        }

        $tagContent = '';
        $closeButton = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
        if (!empty($tagContents['info'])) {
            $tagContent .= '<div class="alert alert-info alert-dismissible" role="alert">';
            $tagContent .= $closeButton . implode('', $tagContents['info']) . '</div>';
        }
        if (!empty($tagContents['success'])) {
            $tagContent .= '<div class="alert alert-success alert-dismissible" role="alert">';
            $tagContent .= $closeButton . implode('', $tagContents['success']) . '</div>';
        }
        if (!empty($tagContents['warning'])) {
            $tagContent .= '<div class="alert alert-warning alert-dismissible" role="alert">';
            $tagContent .= $closeButton . implode('', $tagContents['warning']) . '</div>';
        }
        if (!empty($tagContents['danger'])) {
            $tagContent .= '<div class="alert alert-danger alert-dismissible" role="alert">';
            $tagContent .= $closeButton . implode('', $tagContents['danger']) . '</div>';
        }

        $this->tag->setContent($tagContent);
        return $this->tag->render();
    }
}
