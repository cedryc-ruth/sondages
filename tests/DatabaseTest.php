<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use App\Models\Database;

final class DatabaseTest extends TestCase
{
    public function testDatabaseDeleteResponse(): void
    {
        //Préparation
        $db = new Database;

        $surveys = $db->loadSurveysByOwner('marc');
        $response = $surveys[0]->getResponses()[0];

        //Utilisation
        $result = $db->deleteResponse($response);

        //Vérifications
        $this->assertTrue($result);
        $this->assertNotSame($response, $surveys[0]->getResponses()[0]);
    }
}