#include <stdio.h>

int main(){
    
    int tam, i, j;
    
    printf ("Digite o tamanho da matriz: \n");
    while(scanf("%d", &tam) && tam != 0){
    	int matriz[tam][tam];
    	
    	printf ("Digite a matriz: \n");
    	for(i=0;i<tam;i++){
    		for(j=0;j<tam;j++){
    			scanf("%d",&matriz[i][j]);
			}
		}
		
		int diagonalp = 0, diagonals = 0;
		for(i=0;i<tam;i++){
    		for(j=0;j<tam;j++){
    			if(i == j){
    				diagonalp+= matriz[i][j];
				}
				if(i + j == tam - 1){
					diagonals+= matriz[i][j];
				}
			}
		}
		 printf ("Diferença das diagonais:  %d \n", diagonalp - diagonals);
		 printf ("\n\nDigite o tamanho da matriz ou 0 para sair: \n");
	}
	

    return 0;
}
