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
from ninja import ModelSchema, Schema
from typing import List
from .models import Livro, Autor, Categoria

class LivroInputSchema(Schema):
    titulo: str
    isbn: str
    ano_publicacao: int
    autores: List[int]
    categorias: List[int]


class LivroOutputSchema(Schema):
    id: int
    titulo: str
    isbn: str
    ano_publicacao: int
    autores: List[int]
    categorias: List[int]

    @staticmethod
    def resolve_autores(obj):
        return [autor.id for autor in obj.autores.all()]

    @staticmethod
    def resolve_categorias(obj):
        return [categoria.id for categoria in obj.categorias.all()]

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

@api.get("/livros/", response=List[LivroOutputSchema])
def listar_livros(request):
    return Livro.objects.all()

@api.post("/livros/", response=LivroOutputSchema)
def criar_livro(request, livro: LivroInputSchema):
    autores = Autor.objects.filter(id__in=livro.autores)
    categorias = Categoria.objects.filter(id__in=livro.categorias)
    novo_livro = Livro.objects.create(
        titulo=livro.titulo, isbn=livro.isbn, ano_publicacao=livro.ano_publicacao
    )
    novo_livro.autores.set(autores)
    novo_livro.categorias.set(categorias)
    return novo_livro


from django.shortcuts import get_object_or_404

@api.put("/livros/{livro_id}/", response=LivroOutputSchema)
def atualizar_livro(request, livro_id: int, livro: LivroInputSchema):
    livro_obj = get_object_or_404(Livro, id=livro_id)
    
    livro_obj.titulo = livro.titulo
    livro_obj.isbn = livro.isbn
    livro_obj.ano_publicacao = livro.ano_publicacao
    livro_obj.save()

    autores = Autor.objects.filter(id__in=livro.autores)
    categorias = Categoria.objects.filter(id__in=livro.categorias)
    livro_obj.autores.set(autores)
    livro_obj.categorias.set(categorias)

    return livro_obj

@api.delete("/livros/{livro_id}/", response={200: dict, 404: dict})
def excluir_livro(request, livro_id: int):
    livro_obj = Livro.objects.filter(id=livro_id).first()
    if not livro_obj:
        return 404, {"error": "Livro não encontrado."}

    livro_obj.delete()
    return {"message": "Livro excluído com sucesso!"}
