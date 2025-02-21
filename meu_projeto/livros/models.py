from django.db import models

# Create your models here.
class Autor(models.Model):
    nome = models.CharField(max_length=255)

class Categoria(models.Model):
    nome = models.CharField(max_length=255)

class Livro(models.Model):
    titulo = models.CharField(max_length=255)
    isbn = models.CharField(max_length=13, unique=True)
    ano_publicacao = models.IntegerField()
    autores = models.ManyToManyField(Autor)
    categorias = models.ManyToManyField(Categoria)