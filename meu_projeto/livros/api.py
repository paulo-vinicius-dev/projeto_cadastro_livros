from ninja import NinjaAPI, ModelSchema
from typing import List
from .models import Autor, Categoria, Livro

class AutorSchema(ModelSchema):
    class Config:
        model = Autor
        model_fields = '__all__'

class CategoriaSchema(ModelSchema):
    class Config:
        model = Categoria
        model_fields = '__all__'

class LivroSchema(ModelSchema):
    autores: List[int]
    categorias: List[int]

    class Config:
        model = Livro
        model_fields = ['titulo', 'isbn', 'ano_publicacao']

api = NinjaAPI()

@api.get("/autores/", response=List[AutorSchema])
def listar_autores(request):
    return Autor.objects.all()

@api.post("/autores/", response=AutorSchema)
def criar_autor(request, autor: AutorSchema):
    return Autor.objects.create(**autor.dict())

@api.put("/autores/{autor_id}/", response=AutorSchema)
def atualizar_autor(request, autor_id: int, autor: AutorSchema):
    autor_obj = Autor.objects.get(id=autor_id)
    for attr, value in autor.dict().items():
        setattr(autor_obj, attr, value)
    autor_obj.save()
    return autor_obj

@api.delete("/autores/{autor_id}/", response=dict)
def excluir_autor(request, autor_id: int):
    autor_obj = Autor.objects.get(id=autor_id)
    autor_obj.delete()
    return {"message": "Autor excluído com sucesso!"}

@api.get("/categorias/", response=List[CategoriaSchema])
def listar_categorias(request):
    return Categoria.objects.all()

@api.post("/categorias/", response=CategoriaSchema)
def criar_categoria(request, categoria: CategoriaSchema):
    return Categoria.objects.create(**categoria.dict())

@api.put("/categorias/{categoria_id}/", response=CategoriaSchema)
def atualizar_categoria(request, categoria_id: int, categoria: CategoriaSchema):
    categoria_obj = Categoria.objects.get(id=categoria_id)
    for attr, value in categoria.dict().items():
        setattr(categoria_obj, attr, value)
    categoria_obj.save()
    return categoria_obj

@api.delete("/categorias/{categoria_id}/", response=dict)
def excluir_categoria(request, categoria_id: int):
    categoria_obj = Categoria.objects.get(id=categoria_id)
    categoria_obj.delete()
    return {"message": "Categoria excluída com sucesso!"}

@api.get("/livros/", response=List[LivroSchema])
def listar_livros(request):
    return Livro.objects.all()

@api.post("/livros/", response=LivroSchema)
def criar_livro(request, livro: LivroSchema):
    autores = Autor.objects.filter(id__in=livro.autores)
    categorias = Categoria.objects.filter(id__in=livro.categorias)
    novo_livro = Livro.objects.create(
        titulo=livro.titulo, isbn=livro.isbn, ano_publicacao=livro.ano_publicacao
    )
    novo_livro.autores.set(autores)
    novo_livro.categorias.set(categorias)
    return novo_livro

@api.put("/livros/{livro_id}/", response=LivroSchema)
def atualizar_livro(request, livro_id: int, livro: LivroSchema):
    livro_obj = Livro.objects.get(id=livro_id)
    livro_obj.titulo = livro.titulo
    livro_obj.isbn = livro.isbn
    livro_obj.ano_publicacao = livro.ano_publicacao
    livro_obj.save()

    autores = Autor.objects.filter(id__in=livro.autores)
    categorias = Categoria.objects.filter(id__in=livro.categorias)
    livro_obj.autores.set(autores)
    livro_obj.categorias.set(categorias)

    return livro_obj

@api.delete("/livros/{livro_id}/", response=dict)
def excluir_livro(request, livro_id: int):
    livro_obj = Livro.objects.get(id=livro_id)
    livro_obj.delete()
    return {"message": "Livro excluído com sucesso!"}