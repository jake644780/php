<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termék feltöltés</title>
</head>
<body>
    <h1>Termék feltöltés</h1>
    <form action="add_product.php" method="post" enctype="multipart/form-data">

        <label for="name">Termék név:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="price">Ár (Ft):</label><br>
        <input type="number" id="price" name="price" required><br><br>

        <label for="gender">Nem:</label><br>
        <select name="gender" id="gender" required>
            <option value="male">Férfi</option>
            <option value="female">Női</option>
        </select><br><br>

        <label for="brand">Márka:</label><br>
        <input type="text" id="brand" name="brand" required><br><br>

        <label for="strength">Koncentráció:</label><br>
        <select name="strength" id="strength" required>
            <option value="Extrait de Parfum">Extrait de Parfum</option>
            <option value="Eau de Parfum">Eau de Parfum</option>
            <option value="Eau de Toilette">Eau de Toilette</option>
            <option value="Eau de Cologne">Eau de Cologne</option>
        </select><br><br>

        <label for="ptype">Típus</label><br>
        <select name="ptype" id="ptype" required>
            <option value="parfum">Parfüm</option>
            <option value="parfumolaj">Parfümolaj</option>
            <option value="szett">Szett</option>
            <option value="minta">Minta</option>
        </select><br><br>

        <label for="originalprice">Eredeti ár (akció esetén)</label><br>
        <input type="number" name="originalprice" id="originalprice"><br><br>

        <label for="thumbnail">Kép:</label><br>
        <input type="file" id="thumbnail" name="thumbnail" required><br><br>

        <label for="image1">Termékoldal kép 1:</label><br>
        <input type="file" id="image1" name="image1" required><br><br>

        <label for="image2">Termékoldal kép 2:</label><br>
        <input type="file" id="image2" name="image2" required><br><br>

        <label for="description">Leírás:</label><br>
        <textarea id="description" name="description" rows="20" cols="50" maxlength="2000" required></textarea><br><br>

        <label for="desc_short">Rövid leírás: (max 400 karakter)</label><br>
        <textarea name="desc_short" id="desc_short" cols="30" rows="10" maxlength="400" required></textarea>

        <label for="flavor_table">Illat:</label><br>
        <table>
            <tr>
                <td>Fej</td>
                <td><input type="text" id="fej" name="fej" ></td>
            </tr>
            <tr>
                <td>Szív</td>
                <td><input type="text" id="sziv" name="sziv" ></td>
            </tr>
            <tr>
                <td>Alap</td>
                <td><input type="text" id="alap" name="alap" ></td>
            </tr>
        </table><br><br>

        <label for="size">Kiszerelés (pl. 100 ml):</label><br>
        <input type="text" id="size" name="size" required><br><br>

        <label for="stock">Raktáron lévő darabszám:</label><br>
        <input type="number" id="stock" name="stock" required><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>


