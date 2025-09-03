<?php

declare(strict_types=1);

namespace Neighbourhoodie\Telemetry\EventListener;

use Psr\Log\LoggerInterface;
use TYPO3\CMS\Core\Attribute\AsEventListener;
use TYPO3\CMS\Core\Authentication\Event\AfterUserLoggedInEvent;
use Neighbourhoodie\Telemetry\Service\TelemetryService;
use OpenTelemetry\SDK\Metrics\Counter;

#[AsEventListener(
    identifier: 'telemetry/login-listener',
    event: AfterUserLoggedInEvent::class,
)]
final readonly class LoginListener
{
  private Counter $loginCounter;

  public function __construct(private readonly LoggerInterface $logger)
  {
      $meter = TelemetryService::getMeter();
      $this->loginCounter = $meter->createCounter('login');
  }
  
  public function __invoke(AfterUserLoggedInEvent $event): void
    {
      $this->logger->info("Telemetry Event handler for  AfterUserLoggedInEvent"); 

      $user = $event->getUser();
      $userType = get_class($user);
      
      $isEditor = false;
      foreach ($user->userGroups as $group) {
          if (($group['title'] ?? null) === 'Editor') {
              $isEditor = true;
              break;
          }
      }

      $this->loginCounter->add(1, [
          'loginType' => $user->loginType,
          'isEditor'  => $isEditor,
      ]);
    }
}
