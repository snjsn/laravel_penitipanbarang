<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $items = Item::when($search, function($query) use ($search) {
            return $query->where('nama', 'like', '%'.$search.'%')
                         ->orWhere('deskripsi', 'like', '%'.$search.'%');
        })
        ->latest()
        ->paginate(10)
        ->appends(['search' => $search]);

        return view('items.index', compact('items', 'search'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $validatedData = $request->validate([
        'nama' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'jenis' => 'required|in:pakaian,elektronik,dokumen',
        'kondisi' => 'required|in:baru,bekas',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    $validatedData['foto'] = $this->handleImageUpload($request);
    $validatedData['status'] = 'tersedia';
    $validatedData['tanggal_masuk'] = now();

    Item::create($validatedData);

    return redirect()->route('items.index')
        ->with('success', 'Barang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
    $validatedData = $request->validate([
        'nama' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'jenis' => 'required|in:pakaian,elektronik,dokumen',
        'kondisi' => 'required|in:baru,bekas',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    $validatedData['foto'] = $this->handleImageUpload($request, $item);
    $item->update($validatedData);

    return redirect()->route('items.index')
        ->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy(Item $item)
    {
        try {
            \DB::beginTransaction();
            
            // Delete the image if exists
            if ($item->foto) {
                $filePath = 'public/' . $item->foto;
                \Log::info('Attempting to delete file: ' . $filePath);
                
                if (Storage::exists($filePath)) {
                    if (!Storage::delete($filePath)) {
                        \Log::error('Failed to delete file: ' . $filePath);
                        throw new \Exception('Failed to delete file: ' . $filePath);
                    }
                    \Log::info('Successfully deleted file: ' . $filePath);
                } else {
                    \Log::warning('File not found: ' . $filePath);
                }
            }

            $item->delete();
            
            \DB::commit();

            return redirect()->route('items.index')
                ->with('success', 'Barang berhasil dihapus');
                
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Error deleting item: ' . $e->getMessage());
            
            return redirect()->route('items.index')
                ->with('error', 'Gagal menghapus barang. Silakan coba lagi.');
        }
    }

    public function updateStatus(Item $item)
    {
        $item->status = 'diambil';
        $item->save();

        \Log::info('Item status updated to diambil', ['item_id' => $item->id]);

        return redirect()->route('items.index')->with('success', 'Status barang berhasil diperbarui menjadi diambil.');
    }

    public function history()
    {
        \Log::info('Accessing history page');
        
        $items = Item::where('status', 'diambil') ->latest() ->paginate(10);
    
        \Log::info('History items query result', [
            'count' => $items->count(),
            'total' => $items->total(),
            'status_check' => Item::where('status', 'diambil')->count()
        ]);
    
        return view('items.history', compact('items'));
    }

    private function handleImageUpload($request, $item = null)
    {
    if ($request->hasFile('foto')) {
        // Delete old image if exists
        if ($item && $item->foto) {
            Storage::delete($item->foto);
        }
        
        // Store the new image
        $path = $request->file('foto')->store('items', 'public');
        return $path;
    }
    
    return $item ? $item->foto : null;
    }

}