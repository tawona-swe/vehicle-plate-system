# railway.nix
{ pkgs }:
pkgs.mkShell {
  buildInputs = [
    pkgs.php82
    pkgs.php82Packages.composer
    pkgs.mysql80
  ];
}
