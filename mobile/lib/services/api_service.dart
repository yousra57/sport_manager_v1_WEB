import 'dart:convert';
import 'package:http/http.dart' as http;

class ApiService {
  // Adresse de notre serveur PHP local
  // Pour Chrome sur ce PC, la valeur par défaut convient.
  // Peut être changée au lancement avec --dart-define=API_BASE_URL=...
  static const String baseUrl = String.fromEnvironment(
    'API_BASE_URL',
    defaultValue: 'http://localhost:8001',
  );

  // Client remplaçable dans les tests : ils n'ont pas besoin de MariaDB.
  static http.Client client = http.Client();

  // Fonction commune pour envoyer les requêtes GET
  static Future<dynamic> _get(String endpoint) async {
    final url = Uri.parse('$baseUrl$endpoint');

    final response = await client
        .get(url, headers: {'Accept': 'application/json'})
        .timeout(const Duration(seconds: 10));

    if (response.statusCode != 200) {
      throw Exception('Erreur serveur : ${response.statusCode}');
    }

    final resultat = jsonDecode(utf8.decode(response.bodyBytes));

    if (resultat['success'] != true) {
      throw Exception('La requête API a échoué');
    }

    return resultat['data'];
  }

  // Les 4 fonctions suivantes utilisent la fonction _get pour récupérer les données depuis l'API PHP
  // Récupérer toutes les équipes : Endpoint PHP --> /api/equipes
  static Future<List<dynamic>> getEquipes() async {
    final data = await _get('/api/equipes');
    return List<dynamic>.from(data);
  }

  // Récupérer tous les joueurs : Endpoint PHP --> /api/joueurs
  static Future<List<dynamic>> getJoueurs() async {
    final data = await _get('/api/joueurs');
    return List<dynamic>.from(data);
  }

  // Récupérer le détail d'une équipe : Endpoint PHP --> /api/equipe/{id}
  static Future<Map<String, dynamic>> getEquipe(int id) async {
    final data = await _get('/api/equipe/$id');
    return Map<String, dynamic>.from(data);
  }

  // Récupérer le détail d'un joueur : Endpoint PHP --> /api/joueur/{id}
  static Future<Map<String, dynamic>> getJoueur(int id) async {
    final data = await _get('/api/joueur/$id');
    return Map<String, dynamic>.from(data);
  }
}
