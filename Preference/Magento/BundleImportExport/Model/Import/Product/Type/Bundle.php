<?php declare(strict_types=1);
/**
 * MageQuest - https://magequest.io
 * Copyright © MageQuest. All rights reserved.
 * See LICENSE.md file for details.
 */

namespace MageQuest\BundleImportExportEnhancements\Preference\Magento\BundleImportExport\Model\Import\Product\Type;

use Magento\BundleImportExport\Model\Import\Product\Type\Bundle as BundleImport;
use Magento\CatalogImportExport\Model\Import\Product\Type\AbstractType;

class Bundle extends BundleImport
{
    protected array $optionsToDelete = [];
    protected bool $haveOptionsBeenDeleted = false;

    /**
     * Store product IDs where the empty value separator is present for the 'bundle_values' column
     */
    protected function parseSelections($rowData, $entityId): array
    {
        if ($rowData['bundle_values'] === $this->_entityModel->getEmptyAttributeValueConstant()) {
            $this->optionsToDelete[] = $entityId;
        }

        return parent::parseSelections($rowData, $entityId);
    }

    /**
     * Remove options for specified products before any new/existing options are imported
     */
    protected function populateExistingOptions(): AbstractType
    {
        $this->deleteExistingOptionsAndSelections();

        return parent::populateExistingOptions();
    }

    /**
     * Ensure options are removed, even if no new/existing options are present in the data
     */
    public function saveData(): AbstractType
    {
        $result = parent::saveData();
        $this->deleteExistingOptionsAndSelections();

        return $result;
    }

    /**
     * Delete selections/options for the collated product IDs, but ensure
     * it is not run twice when new/updated options exist in the import data
     * (i.e. new/updated options are not inadvertently deleted)
     */
    protected function deleteExistingOptionsAndSelections(): void
    {
        if (!$this->haveOptionsBeenDeleted && !empty($this->optionsToDelete)) {
            $this->deleteOptionsAndSelections($this->optionsToDelete);
            $this->haveOptionsBeenDeleted = true;
        }
    }
}
