<?php
namespace SpoonerWeb\PaginatedProcessing\DataProcessing;

use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\DataProcessing\DatabaseQueryProcessor;

class PaginatedDatabaseQueryProcessor extends DatabaseQueryProcessor
{

    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ) {
        $allProcessorConfiguration = $processorConfiguration;
        unset($allProcessorConfiguration['max.']);
        $allProcessedData = parent::process($cObj, $contentObjectConfiguration, $allProcessorConfiguration, $processedData);
        $paginationSettings = $processorConfiguration['paginate.'];
        $paginationActive = (int)$paginationSettings['activate'] === 1;

        $parameter = $cObj->getRequest()->getQueryParams()[$paginationSettings['parameterIndex']];
        if ($paginationActive) {
            $itemsPerPage = (int)($cObj->getData($processorConfiguration['max.']['data']) ?: $paginationSettings['itemsPerPage']);
            $page = (int)$parameter['page'] ?? 0;
            $start = 0;
            if ($page > 1) {
                $start = $itemsPerPage * ($page - 1);
            }

            unset($processorConfiguration['max.']);
            $processorConfiguration['max'] = $itemsPerPage;
            $processorConfiguration['begin'] = $start;
        }

        $parentProcessedData = parent::process($cObj, $contentObjectConfiguration, $processorConfiguration, $processedData);

        if ($paginationActive) {
            $numberPages = ceil(count($allProcessedData[$processorConfiguration['as']]) / $itemsPerPage);
            $pageLinks[1] = $cObj->getTypoLink_URL($cObj->data['pid']);
            if ($numberPages > 1) {
                for ($i = 2; $i <= $numberPages; $i++) {
                    $pageLinks[$i] = $cObj->getTypoLink_URL(
                        $cObj->data['pid'],
                        [
                            $paginationSettings['parameterIndex'] => [
                                'page' => $i
                            ]
                        ]
                    );
                }
            }
            $parentProcessedData['pagination'][$paginationSettings['parameterIndex']] = [
                'itemsPerPage' => $itemsPerPage,
                'page' => $page,
                'start' => $start,
                'numberOfRecords' => count($allProcessedData['news']),
                'numberOfPages' => $numberPages,
                'pageLinks' => $pageLinks,
                'settings' => $paginationSettings,
            ];
        }

        return $parentProcessedData;
    }
}
