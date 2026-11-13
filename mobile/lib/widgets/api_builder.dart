import 'package:flutter/material.dart';

// Lance la demande une seule fois à l'ouverture, et permet de réessayer.
// Un rebuild de l'écran (par exemple une recherche) ne relance pas la requête.
class ApiBuilder<T> extends StatefulWidget {
  const ApiBuilder({super.key, required this.charger, required this.builder});
  final Future<T> Function() charger;
  final Widget Function(T donnees) builder;

  @override
  State<ApiBuilder<T>> createState() => _ApiBuilderState<T>();
}

class _ApiBuilderState<T> extends State<ApiBuilder<T>> {
  late Future<T> _demande;

  @override
  void initState() {
    super.initState();
    _demande = widget.charger();
  }

  @override
  Widget build(BuildContext context) => FutureBuilder<T>(
    future: _demande,
    builder: (context, snapshot) {
      if (snapshot.connectionState != ConnectionState.done) {
        return const Center(child: CircularProgressIndicator());
      }
      if (snapshot.hasError) {
        return Center(
          child: Padding(
            padding: const EdgeInsets.all(24),
            child: Column(
              mainAxisSize: MainAxisSize.min,
              children: [
                const Text(
                  'Impossible de charger les données. Vérifie que le serveur API est démarré.',
                  textAlign: TextAlign.center,
                ),
                const SizedBox(height: 12),
                FilledButton(
                  onPressed: () {
                    final demande = widget.charger();
                    setState(() {
                      _demande = demande;
                    });
                  },
                  child: const Text('Réessayer'),
                ),
              ],
            ),
          ),
        );
      }
      return widget.builder(snapshot.data as T);
    },
  );
}
