<?php
require_once FCPATH . 'vendor/autoload.php';

use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Blob\Models\CreateBlockBlobOptions;
use MicrosoftAzure\Storage\Blob\Models\DeleteBlobOptions;
use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;

class Azure_blob {
    private $blobClient;
    private $defaultContainer;

    public function __construct()
    {
        $accountName = 'storagepublicdivision';
        $accountKey = 'G9Z2TkJqK1raFTEzpWbETXK6LHwrlxJz1vPZ70jinIutt7DijWQVUgjorgSEkdqXDQiQkOU4t95Z+ASt+LswZQ==';

        $this->defaultContainer = 'epact';
        $connectionString = "DefaultEndpointsProtocol=https;AccountName={$accountName};AccountKey={$accountKey};EndpointSuffix=core.windows.net";
        $this->blobClient = BlobRestProxy::createBlobService($connectionString);
    }

    /**
     * Upload file ke Azure
     * @param string $filePath Lokasi file di server
     * @param string $blobName Nama file (boleh pakai subfolder, contoh: ttd_epakta/nama.jpg)
     * @param string|null $containerName Nama container (default: epact)
     * @return string|false URL blob jika sukses, false jika gagal
     */
    public function uploadBlob($filePath, $blobName, $containerName = null)
    {
        $container = $containerName ?: $this->defaultContainer;

        try {
            // Pastikan container ada
            if (!$this->containerExists($container)) {
                $this->createContainer($container);
            }

            $content = fopen($filePath, "r");
            $options = new CreateBlockBlobOptions();
            $options->setContentType(mime_content_type($filePath));

            $this->blobClient->createBlockBlob($container, $blobName, $content, $options);

            return "https://{$this->blobClient->getAccountName()}.blob.core.windows.net/{$container}/{$blobName}";
        } catch (ServiceException $e) {
            log_message('error', 'Azure Blob Upload Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Hapus file dari Azure
     */
    public function deleteBlob($blobName, $containerName = null)
    {
        $container = $containerName ?: $this->defaultContainer;

        try {
            $this->blobClient->deleteBlob($container, $blobName);
            return true;
        } catch (ServiceException $e) {
            log_message('error', 'Azure Blob Delete Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Cek apakah container sudah ada
     */
    public function containerExists($containerName)
    {
        try {
            $result = $this->blobClient->listContainers();
            foreach ($result->getContainers() as $container) {
                if ($container->getName() === $containerName) {
                    return true;
                }
            }
            return false;
        } catch (ServiceException $e) {
            log_message('error', 'Azure Container Check Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Buat container baru jika belum ada
     */
    public function createContainer($containerName)
    {
        try {
            $createContainerOptions = new CreateContainerOptions();
            $createContainerOptions->setPublicAccess('blob'); // public URL access

            $this->blobClient->createContainer($containerName, $createContainerOptions);
            return true;
        } catch (ServiceException $e) {
            log_message('error', 'Azure Create Container Error: ' . $e->getMessage());
            return false;
        }
    }
}
