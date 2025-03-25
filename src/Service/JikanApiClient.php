<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\Season;
use App\Entity\TopSeason;
use App\Exception\JikanApiClientException;
use Doctrine\ORM\EntityManagerInterface;
use JsonException;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final readonly class JikanApiClient
{
    public function __construct(
        private HttpClientInterface $httpClient,
        private LoggerInterface $logger,
        #[Autowire('%api_url%')] private string $apiUrl,
        private EntityManagerInterface $em,
    ) {
    }

    /**
     * @return array{
     *     pagination: array<string, mixed>,
     *     data: array
     * }
     * @throws JikanApiClientException If API request fails or not return 200 status code.
     */
    public function getTop(int $page): array
    {
        try {
            $response = $this->httpClient->request(
                'GET',
                $this->apiUrl.'/top/anime',
                [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ],
                    'query' => [
                        'page' => $page,
                        'type' => 'tv',
                    ],
                ]
            );

            $content = $response->getContent();

            if ($response->getStatusCode() !== Response::HTTP_OK) {
                throw new JikanApiClientException('Failed to get Jikan API response');
            }

            return json_decode($content, true, 512, JSON_THROW_ON_ERROR);
        } catch (ClientExceptionInterface|RedirectionExceptionInterface|ServerExceptionInterface|TransportExceptionInterface|JsonException|JikanApiClientException $e) {
            $this
                ->logger
                ->error(sprintf("JikanApiClient returned an error response: %s ", $e->getMessage()));
            throw new JikanApiClientException($e->getMessage());
        }
    }

    /**
     * @return array{
     *     data: array
     * }
     * @throws JikanApiClientException If API request fails or not return 200 status code.
     */
    public function getSeasonDetails(int $externalId): array
    {
        try {
            $response = $this->httpClient->request(
                'GET',
                $this->apiUrl.'/anime/'.$externalId.'/full',
                [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ],
                ]
            );


            $content = $response->getContent();

            $decodedContent = json_decode($content, true, 512, JSON_THROW_ON_ERROR);
            $season = (new Season())
                ->setExternalId((string)$externalId)
                ->setTitle($decodedContent['data']['title']); //TODO: other fields

            $topSeason = $this->em->getRepository(TopSeason::class)->findOneBy(['externalId' => $externalId]);
//            $season->setTopSeason($topSeason)

            if ($response->getStatusCode() !== Response::HTTP_OK) {
                throw new JikanApiClientException('Failed to get Jikan API response');
            }

            return [];
        } catch (ClientExceptionInterface|RedirectionExceptionInterface|ServerExceptionInterface|TransportExceptionInterface|JsonException|JikanApiClientException $e) {
            $this
                ->logger
                ->error(sprintf("JikanApiClient returned an error response: %s ", $e->getMessage()));
            throw new JikanApiClientException($e->getMessage());
        }
    }
}