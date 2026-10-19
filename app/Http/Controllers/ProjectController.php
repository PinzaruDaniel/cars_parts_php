/*
namespace App\Http\Controllers;

use App\Models\CarPart;
use Illuminate\Contracts\View\View;

class ProjectController extends Controller
{
    public const string APP_VERSION = '0.1.0';










    public function administration(): View
    {
        if (!in_array(self::DEMO_ROLE, ['operator', 'administrator'], true)) {
            abort(403, 'Nu ai acces la aceasta pagina');
        }
        return view('pages.administration', array_merge($this->commonViewData('Administrare'), ['carParts' => $this->carParts()]));
    }

    /**
     * @return array<string, string>
     */
    private function commonViewData(string $pageTitle): array
    {
        return [
            'projectName' => 'Car Parts',
            'pageTitle' => $pageTitle,
            'author' => 'Pînzaru Daniel',
            'group' => 'PAPP-231',
            'description' => 'Aplicație web pentru administrarea unui magazin de piese auto și preluarea datelor introduse de utilizatori prin formulare.',
            'version' => self::APP_VERSION,
            'role' => self::DEMO_ROLE,
        ];
    }

    /**
     * @return array<int, CarPart>
     */
    private function carParts(): array
    {
        return [
            new CarPart(
                id: 1,
                name: 'Plăcuțe de frână față',
                code: 'BP-BRE-001',
                category: 'Sistem de frânare',
                manufacturer: 'Brembo',
                price: 849.99,
                stockQuantity: 12,
                isAvailable: true,
            ),
            new CarPart(
                id: 2,
                name: 'Filtru de ulei',
                code: 'OF-MAN-002',
                category: 'Filtrare',
                manufacturer: 'MANN-FILTER',
                price: 250.00,
                stockQuantity: 5,
                isAvailable: true,
            ),
            new CarPart(
                id: 3,
                name: 'Kit ambreiaj',
                code: 'CK-LUK-003',
                category: 'Transmisie',
                manufacturer: 'LuK',
                price: 1200.00,
                stockQuantity: 0,
                isAvailable: false,
            ),
        ];
    }

}*/
