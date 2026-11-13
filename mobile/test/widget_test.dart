import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:flutter_test/flutter_test.dart';
import 'package:http/http.dart' as http;
import 'package:http/testing.dart';
import 'package:mobile/main.dart';
import 'package:mobile/services/api_service.dart';

const equipe = {
  'id_equipe': 1,
  'nom_equipe': 'Paris FC',
  'coach_nom': 'Coach principal',
  'date_creation': '2024-01-01',
  'couleur': '#0055A4',
  'nb_joueurs': 1,
};
const joueur = {
  'id_joueur': 7,
  'prenom': 'Théo',
  'nom': 'Test',
  'poste_nom': 'Milieu',
  'equipe_nom': 'Paris FC',
  'age': null,
  'numero': null,
  'vitesse': 80,
  'endurance': 70,
  'technique': 60,
  'force_physique': 50,
  'est_blesse': 0,
};

void main() {
  tearDown(() => ApiService.client.close());

  testWidgets('Les listes et détails affichent les données API', (
    tester,
  ) async {
    final chemins = <String>[];
    ApiService.client = MockClient((request) async {
      chemins.add(request.url.path);
      final Object data;
      switch (request.url.path) {
        case '/api/equipes':
          data = [equipe];
        case '/api/joueurs':
          data = [joueur];
        case '/api/equipe/1':
          data = {
            ...equipe,
            'joueurs': [joueur],
          };
        case '/api/joueur/7':
          data = joueur;
        default:
          throw StateError('Route inattendue');
      }
      return http.Response(
        jsonEncode({'success': true, 'data': data}),
        200,
        headers: {'content-type': 'application/json; charset=utf-8'},
      );
    });

    await tester.pumpWidget(const SportManagerApp());
    await tester.pumpAndSettle();
    expect(find.text('SPORT MANAGER'), findsOneWidget);

    await tester.tap(find.text('Équipes').last);
    await tester.pumpAndSettle();
    await tester.tap(find.text('Paris FC'));
    await tester.pumpAndSettle();
    expect(find.text('Théo Test'), findsOneWidget);
    await tester.tap(find.text('Théo Test'));
    await tester.pumpAndSettle();
    expect(
      find.text('Âge non renseigné'),
      findsNothing,
    ); // texte combiné avec le poste
    expect(find.textContaining('Âge non renseigné'), findsOneWidget);
    expect(find.text('Paris FC'), findsOneWidget);
    expect(
      chemins,
      containsAll([
        '/api/equipes',
        '/api/joueurs',
        '/api/equipe/1',
        '/api/joueur/7',
      ]),
    );

    await tester.pageBack();
    await tester.pumpAndSettle();
    await tester.pageBack();
    await tester.pumpAndSettle();
    await tester.tap(find.text('Joueurs').last);
    await tester.pumpAndSettle();
    expect(find.text('Théo Test'), findsOneWidget);
    await tester.enterText(find.byType(TextField), 'absent');
    await tester.pumpAndSettle();
    expect(find.text('Aucun joueur trouvé.'), findsOneWidget);
    // La recherche ne doit pas déclencher une nouvelle requête HTTP.
    expect(chemins.where((p) => p == '/api/joueurs').length, 1);
  });

  testWidgets('Une erreur permet de réessayer puis affiche une liste vide', (
    tester,
  ) async {
    var echec = true;
    ApiService.client = MockClient((request) async {
      if (echec) return http.Response('{}', 500);
      return http.Response(jsonEncode({'success': true, 'data': []}), 200);
    });
    await tester.pumpWidget(const SportManagerApp());
    await tester.pumpAndSettle();
    await tester.tap(find.text('Équipes').last);
    await tester.pumpAndSettle();
    expect(find.text('Réessayer'), findsOneWidget);
    echec = false;
    await tester.tap(find.text('Réessayer'));
    await tester.pumpAndSettle();
    expect(find.text('Aucune équipe pour le moment.'), findsOneWidget);
  });
}
