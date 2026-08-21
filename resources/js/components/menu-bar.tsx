import * as React from 'react';
import { cn } from '@/lib/utils';
import {
    ReceiptText,
    ArrowUpDown,
    Refrigerator,
    Salad,
} from 'lucide-react';

export function MenuBar() {
    const [isActive, setIsActive] = React.useState<string>('products');

    function checkIsActive(id: string) {
        return id === isActive;
    }

    return (
        <>
            <div
                className={cn(
                    'fixed bottom-10 z-1 w-auto rounded-lg bg-white px-6 py-2 text-[10px] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:bg-[#161615] dark:text-[#EDEDEC] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]',
                )}
            >
                <div className="flex items-center justify-evenly gap-6">
                    <div
                        className={cn(
                            'flex items-center gap-2',
                            checkIsActive('products')
                                ? 'rounded-sm border bg-[#1b1b18] px-2 py-1 text-white transition-all duration-300 hover:bg-black dark:bg-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white'
                                : '',
                        )}
                        onClick={() => setIsActive('products')}
                    >
                        <Salad />
                        {checkIsActive('products') ? 'Produits' : ''}
                    </div>
                    <div
                        className={cn(
                            'flex items-center gap-2',
                            checkIsActive('storages')
                                ? 'rounded-sm border bg-[#1b1b18] px-2 py-1 text-white transition-all duration-300 hover:bg-black dark:bg-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white'
                                : '',
                        )}
                        onClick={() => setIsActive('storages')}
                    >
                        <Refrigerator />
                        {checkIsActive('storages') ? 'Stockages' : ''}
                    </div>
                    <div
                        className={cn(
                            'flex items-center gap-2',
                            checkIsActive('sheets')
                                ? 'rounded-sm border bg-[#1b1b18] px-2 py-1 text-white transition-all duration-300 hover:bg-black dark:bg-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white'
                                : '',
                        )}
                        onClick={() => setIsActive('sheets')}
                    >
                        <ReceiptText />
                        {checkIsActive('sheets') ? 'Liste de courses' : ''}
                    </div>
                    <div
                        className={cn(
                            'flex items-center gap-2',
                            checkIsActive('movements')
                                ? 'rounded-sm border bg-[#1b1b18] px-2 py-1 text-white transition-all duration-300 hover:bg-black dark:bg-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white'
                                : '',
                        )}
                        onClick={() => setIsActive('movements')}
                    >
                        <ArrowUpDown />
                        {checkIsActive('movements') ? 'Mouvements' : ''}
                    </div>
                </div>
            </div>
        </>
    );
}
