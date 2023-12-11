import unittest
import requests
from db import connect

class TestLinkAvailability(unittest.TestCase):

    def test_link_availability(self):
        url = connect
        response = requests.get(url)

        self.assertEqual(response.status_code, 200)


class TestFileOperations(unittest.TestCase):

    def test_search_string_in_file(self):
        filename = "C:\\Users\\Nikit\\OneDrive\\Рабочий стол\\Vkusno\\Kursovaia\\запросы.txt"
        search_string = "SELECT * FROM Cafes as c WHERE c.Address LIKE '%$search%' "

        with open(filename, "r") as file:
            file_content = file.read()

        self.assertIn(search_string, file_content)

class TestVariableInFile(unittest.TestCase):

    def test_variable_in_file(self):
        file_path = "C:\\Users\\Nikit\\OneDrive\\Рабочий стол\\Vkusno\\Kursovaia\\index.php"

        variable_name = "$title"

        try:
            with open(file_path, "r") as file:
                file_content = file.read()

        except FileNotFoundError:
            self.fail(f"File '{file_path}' not found.")

if __name__ == '__main__':
    unittest.main()
