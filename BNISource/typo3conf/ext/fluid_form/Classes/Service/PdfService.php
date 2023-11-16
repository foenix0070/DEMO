<?php

namespace CodingMs\FluidForm\Service;

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

use Exception;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;

/**
 * PDF service
 *
 *
 * @author Thomas Deuling <typo3@coding.ms>
 */
class PdfService
{
    /**
     * Creates a receiver PDF
     *
     * @param array $form
     * @param int $formObjectUid
     * @return string
     * @throws Exception
     */
    public function createReceiverPdf($form, $formObjectUid = 0)
    {
        $templateName = 'Receiver';
        $templateRootPath = $form['configuration']['pdf']['receiver']['templateRootPath'];
        $partialRootPath = $form['configuration']['pdf']['receiver']['partialRootPath'];
        // Fluid view
        $pdfView = new StandaloneView();
        $partialRootPath = GeneralUtility::getFileAbsFileName($partialRootPath);
        $templateRootPath = GeneralUtility::getFileAbsFileName($templateRootPath);
        $templatePathAndFilename = $templateRootPath . 'Pdf/' . $templateName . '.html';
        // Template found?!
        if (file_exists($templatePathAndFilename)) {
            $pdfView->setPartialRootPaths([$partialRootPath]);
            $pdfView->setTemplatePathAndFilename($templatePathAndFilename);
            $pdfView->assign('form', $form);
            $pdfView->assign('formObjectUid', $formObjectUid);
            return $pdfView->render();
        }
        throw new Exception('PDF-Template ' . $templateRootPath . 'Pdf/' . $templateName . '.html not found!');
    }

    /**
     * Creates a sender PDF
     *
     * @param array $form
     * @param int $formObjectUid
     * @return string
     * @throws Exception
     */
    public function createSenderPdf($form, $formObjectUid = 0)
    {
        $templateName = 'Sender';
        $templateRootPath = $form['configuration']['pdf']['sender']['templateRootPath'];
        $partialRootPath = $form['configuration']['pdf']['sender']['partialRootPath'];
        // Fluid view
        $pdfView = new StandaloneView();
        $partialRootPath = GeneralUtility::getFileAbsFileName($partialRootPath);
        $templateRootPath = GeneralUtility::getFileAbsFileName($templateRootPath);
        $templatePathAndFilename = $templateRootPath . 'Pdf/' . $templateName . '.html';
        // Template found?!
        if (file_exists($templatePathAndFilename)) {
            $pdfView->setPartialRootPaths([$partialRootPath]);
            $pdfView->setTemplatePathAndFilename($templatePathAndFilename);
            $pdfView->assign('form', $form);
            $pdfView->assign('formObjectUid', $formObjectUid);
            return $pdfView->render();
        }
        throw new Exception('PDF-Template ' . $templateRootPath . 'Pdf/' . $templateName . '.html not found!');
    }
}
